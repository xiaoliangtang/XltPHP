<?php
/**
* 首页控制器
*/
class IndexController extends Controller
{

	public function index()
	{
		$welcome = 'Welcome to XltPHP!';
		$this->assign('welcome', $welcome);
		$this->display();
	}

}