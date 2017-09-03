<?php
/**
* 视图类
*/
class View
{

	private $variables = array();
	private $controller;
	private $action;
	
	function __construct($controller, $action)
	{
		$this->controller = $controller;
		$this->action = $action;
		
	}

	/**
	 * 分配变量
	 */
	public function assign($name, $value) {
		$this->variables[$name] = $value;
	}

	/**
	 * 显示视图
	 */
	public function render()
	{


		extract($this->variables);
		
		if (isset($_GET['app']) && $_GET['app'] == 'admin') {

			$template_header = ADMIN_PATH.'/views/public/header.php';
			$template_footer = ADMIN_PATH.'/views/public/footer.php';
			// 加载头部文件
			require_once $template_header;

			require_once ADMIN_PATH.'/views/'.$this->controller.'/'.$this->action.'.php';

			// 加载底部文件
			require_once $template_footer;
		} else {
			$template_header = HOME_PATH.'/views/public/header.php';
			$template_footer = HOME_PATH.'/views/public/footer.php';
			// 加载头部文件
			require_once $template_header;

			require_once HOME_PATH.'/views/'.$this->controller.'/'.$this->action.'.php';

			// 加载底部文件
			require_once $template_footer;
		}
	}

}