<?php
/**
 * 路由处理
 */
class Router
{

	public function router(){

		$this->parser();

	}

	// 解析
	private function parser() {

		$query_string = $_SERVER['QUERY_STRING'];
		$params = array();

		// 解析参数
		if ($query_string != '') {
			$params_first_ex = explode('&', $query_string);
			foreach ($params_first_ex as $val) {
				$params_second_ex = explode('=', $val);
				list($variable, $value) = $params_second_ex;
				$params[$variable] = $value;
			}
		}

		!empty($params['app']) ? $app=$params['app'] : $app='';
		!empty($params['c']) ? $controller=ucfirst($params['c']) : $controller='Index';
		!empty($params['a']) ? $action=$params['a'] : $action='index';

		// 模块路由
		!empty($app) ? $controllerFile = ADMIN_CONTROLLER_PATH.'/'.$controller.'Controller.php' : $controllerFile = HOME_CONTROLLER_PATH.'/'.$controller.'Controller.php';

		if( file_exists($controllerFile) ) {
			// 载入控制器文件
			require_once $controllerFile;
			$c_name = $controller.'Controller';
			// 实例化控制器
			$c = new $c_name($controller,$action);
			$c->$action();
		} else {
			exit($controller.'控制器不存在！');
		}

	}


}