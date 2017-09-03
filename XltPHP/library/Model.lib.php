<?php
/**
* Model
*/
require_once LIB . '/PDO/PDO.class.php';
class Model extends DB
{

	// 实例
	static private $_instance = null;

	// 防止被克隆
	private function __clone()
	{
		
	}

	// 获取实例
	static public function getInstance()
	{
		if (! (self::$_instance instanceof self)) {
			self::$_instance = new self(config('db', 'DB_HOST'), config('db', 'DB_NAME'), config('db', 'DB_USER'), config('db', 'DB_PWD'));
		}

		return self::$_instance;
	}


}