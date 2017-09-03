<?php
/**
* 控制器
*/
class Controller
{
	// 控制器
	protected $_controller;
	// 方法
	protected $_action;
	// 视图
	protected $_view;
	// 数据库实例
	public $DB;

	function __construct($controller, $action)
	{
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_view = new View($controller, $action);
		if (config('db', 'DB_OPEN')) {
			$this->DB = Model::getInstance();
		}
		
	}

	/**
	 * 变量分配
	 */
	public function assign($name, $value)
	{
		$this->_view->assign($name, $value);
	}

	/**
	 * 视图显示
	 */
	public function display()
	{
		$this->_view->render();
	}
}