<?php
/**
* 引导类
*/
class Bootstrap
{

	public function bootstrap(){

		// 自动加载
		new Loader();

		// 路由控制
		new Router();

	}
}
