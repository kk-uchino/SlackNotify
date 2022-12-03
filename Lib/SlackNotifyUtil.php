<?php
class SlackNotifyUtil extends CakeObject
{
	// Slackにメッセージを送信
	static public function sendSlackMessage($botUserOAuthToken, $channel, $text)
	{
		$url = 'https://slack.com/api/chat.postMessage';

		$data = [
			'channel' => $channel,
			'text' => $text,
		];

		$context = [
			'http' => [
				'method'  => 'POST',
				'header'  => implode("\r\n", [
					'Content-Type: application/json',
					'Authorization: Bearer ' . $botUserOAuthToken,
				]),
				'content' => json_encode($data),
			]
		];

		$response = json_decode(file_get_contents($url, false, stream_context_create($context)), true);

		if (!isset($response['ok'])) {
			return false;
		}
		return $response['ok'];
	}
}
