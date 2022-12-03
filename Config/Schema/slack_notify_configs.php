<?php
class SlackNotifyConfigsSchema extends CakeSchema
{

	public $name = 'SlackNotifyConfigs';
	public $file = 'slack_notify_configs.php';

	public function before($event = [])
	{
		return true;
	}

	public function after($event = [])
	{
	}

	public $slack_notify_configs = [
		'id' => ['type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'],
		'name' => ['type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255],
		'value' => ['type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255],
		'created' => ['type' => 'datetime', 'null' => true, 'default' => NULL],
		'modified' => ['type' => 'datetime', 'null' => true, 'default' => NULL],
		'indexes' => ['PRIMARY' => ['column' => 'id', 'unique' => 1]],
	];
}
