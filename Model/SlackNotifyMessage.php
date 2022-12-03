<?php
class SlackNotifyMessage extends AppModel
{
	public function __construct($id = false, $table = null, $ds = null)
	{
		parent::__construct($id, $table, $ds);

		$this->validate = [
			'channel' => [
				['rule' => ['maxLength', 255], 'message' =>  __d('baser', 'チャンネルは255文字以内で入力してください。')],
			],
		];
	}
}
