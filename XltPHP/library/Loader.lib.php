<?php
/**
* 自动加载类
*/
class Loader
{

	public function loader(){

		// 加载类文件
		$this->loadClass();

		// 加载函数文件
		$this->loadFunc();

		// 加载配置文件
		// $this->loadConfig();
	}

	// 加载类文件
	private function loadClass(){
		spl_autoload_register(function($class) {
			$class_file = LIB . '/' . strtolower($class) . '.lib.php';
			if (file_exists($class_file)) {
				require_once $class_file;
			} else {
				exit ('Class '. $class .' is not found');
			}
		});
	}

	// 函数文件
	private function loadFunc(){

		$function_files = array(
			'global' => FUNC . '/global.func.php',
			'tree'	 => FUNC . '/tree.func.php',
			);

		foreach ($function_files as $k => $v) {

			if (file_exists($v)) {
				require_once $v;
			} else {
				exit('Function '. $k .' is not found.');
			}
			
		}
			
	}

	// 配置文件
	private function loadConfig(){

		$config_files = array(
			'config_global' => CONFIG . '/config_global.php',
			'config_db'	=> CONFIG . '/config_db.php'
			);

		foreach ($config_files as $k => $v) {
			if (file_exists($v)) {
				require_once $v;
			} else {
				exit('Config '. $k .' is not found.');
			}
		}

	}

}