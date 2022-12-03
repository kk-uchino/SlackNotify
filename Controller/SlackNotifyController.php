<?php
class SlackNotifyController extends AppController
{
	public $components = ['BcAuth', 'BcAuthConfigure'];
	public $uses = [
		'Mail.MailContent',
		'SlackNotify.SlackNotifyConfig',
		'SlackNotify.SlackNotifyMessage',
	];

	/**
	 * 設定
	 */
	public function admin_config()
	{
		$this->pageTitle = 'Slack通知プラグイン設定';

		$mailContents = $this->MailContent->find('all');
		$this->set('mailContents', $mailContents);

		if (!empty($this->request->data)) {
			$dataSource = $this->SlackNotifyMessage->getDataSource();
			$dataSource->begin();

			$this->SlackNotifyConfig->set($this->request->data);
			if (
				!$this->SlackNotifyMessage->saveAll($this->request->data['SlackNotifyMessage']) ||
				!$this->SlackNotifyConfig->validates() ||
				!$this->SlackNotifyConfig->saveKeyValue($this->request->data['SlackNotifyConfig'])
			) {
				$dataSource->rollback();
				$this->BcMessage->setError(__d('baser', '入力エラーです。内容を修正してください。'));
				return;
			};

			$dataSource->commit();
			$this->BcMessage->setSuccess(__d('baser', '設定を保存しました。'));
		} else {
			$slackNotifyConfigs = $this->SlackNotifyConfig->findExpanded();
			if ($slackNotifyConfigs) {
				$this->request->data['SlackNotifyConfig'] = $slackNotifyConfigs;
			}
			$slackNotifyMessages = $this->SlackNotifyMessage->find('all');
			if ($slackNotifyMessages) {
				$this->request->data['SlackNotifyMessage'] = Hash::combine($slackNotifyMessages, '{n}.SlackNotifyMessage.mail_content_id', '{n}.SlackNotifyMessage');
			}
		}
	}
}
