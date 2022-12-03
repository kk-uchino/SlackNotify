<?php
class SlackNotifyMessagesSchema extends CakeSchema
{

	public $name = 'SlackNotifyMessages';
	public $file = 'slack_notify_messages.php';

	public function before($event = [])
	{
		return true;
	}

	public function after($event = [])
	{
	}

	public $slack_notify_messages = [
		'id' => ['type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'],
		'mail_content_id' => ['type' => 'integer', 'null' => false, 'length' => 11],
		'status' => ['type' => 'tinyinteger', 'null' => true, 'default' => 0, 'length' => 1],
		'channel' => ['type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255],
		'message' => ['type' => 'text', 'null' => true, 'default' => NULL],
		'created' => ['type' => 'datetime', 'null' => true, 'default' => NULL],
		'modified' => ['type' => 'datetime', 'null' => true, 'default' => NULL],
		'indexes' => ['PRIMARY' => ['column' => 'id', 'unique' => 1]],
	];
}
