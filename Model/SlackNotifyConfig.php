<?php
class SlackNotifyConfig extends AppModel
{
	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);

		$this->validate = [
			'bot_user_oauth_token' => [
				['rule' => ['maxLength', 255], 'message' =>  __d('baser', 'Bot User OAuth Tokenは255文字以内で入力してください。')],
			],
		];
	}
}
