<?php
class SlackNotifyControllerEventListener extends BcControllerEventListener
{

	public $events = [
		'Mail.Mail.afterSendEmail',
	];

	public function __construct()
	{
	}

	/**
	 * mailMailAfterSendEmail
	 *
	 * @param CakeEvent $event
	 * @return boolean
	 */
	public function mailMailAfterSendEmail(CakeEvent $event)
	{
		$Controller = $event->subject();

		$SlackNotifyConfig = ClassRegistry::init('SlackNotify.SlackNotifyConfig');
		$slackNotifyConfigs = $SlackNotifyConfig->findExpanded();
		if (empty($slackNotifyConfigs['bot_user_oauth_token'])) {
			return true;
		}
		$botUserOAuthToken = $slackNotifyConfigs['bot_user_oauth_token'];

		$SlackNotifyMessage = ClassRegistry::init('SlackNotify.SlackNotifyMessage');
		$slackNotifyMessages = $SlackNotifyMessage->find('all');
		if (empty($slackNotifyMessages)) {
			return true;
		}
		$slackNotifyMessages = Hash::combine($slackNotifyMessages, '{n}.SlackNotifyMessage.mail_content_id', '{n}.SlackNotifyMessage');

		$entityId = $Controller->request->params['Content']['entity_id'];

		if (!empty($slackNotifyMessages[$entityId]['status']) && !empty($slackNotifyMessages[$entityId]['channel']) && !empty($slackNotifyMessages[$entityId]['message'])) {
			$channel = $slackNotifyMessages[$entityId]['channel'];
			$message = $this->replaceMessage($slackNotifyMessages[$entityId]['message'], $Controller->request->data['MailMessage']);
			SlackNotifyUtil::sendSlackMessage($botUserOAuthToken, $channel, $message);
		}

		return true;
	}

	private function replaceMessage($message, $mailMessage) {
		foreach ($mailMessage as $filedName => $value) {
			$message = str_replace('{{' . $filedName . '}}', $value, $message);
		}
		$message = preg_replace('/\{\{.+\}\}/', '', $message);
		return $message;
	}
}
