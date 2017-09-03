<?php
/**
 *	验证码类
 */
class Verify {

	/**
	 * 验证码配置
	 */
	private $config = array(
		'secretKey'		=> 'XltPHP',					//验证码加密密钥
		'width' 		=> 128,							//验证码宽
		'height' 		=> 50,							//验证码高
		'count'			=> 4,							//验证码个数
		'enText' 		=> 'abcdefghijklmnopqrstuvwxyzABCEDFGHIJKLMNOPQRSTUVWXYZ',
		'fontType' 		=> '',							//字体
		'fontSize' 		=> 36,							//字体大小
		'fontColor'		=> array(),						//字体颜色
		'fontAngle'		=> 8,							//字体偏移值
		'expire' 		=> 1800,						//有效期
		'bgColor' 		=> array(),						//背景颜色
		);

	/**
	 * 验证码资源
	 */
	private $image = null;

	/**
	 * 构造器
	 */
	public function __construct($config = array()){
		session_start();	//开启session
		$this->config['fontType'] = dirname(__FILE__).'/Verify/ttf/ChronicGothic.ttf';				//字体
		$this->config['fontColor'] = array(mt_rand(0,225),mt_rand(0,225),mt_rand(0,225));			//字体颜色
		$this->config['bgColor'] = array(mt_rand(0,225),mt_rand(0,225),mt_rand(0,225));				//背景颜色
		$this->config = array_merge($this->config,$config);
	}

	/**
	 * 获取配置
	 */
	public function __get($name){
		return $this->config[$name];
	}

	/**
	 * 设置配置
	 */
	public function __set($name,$value){
		if (isset($this->config[$name])) {
			$this->config[$name] = $value;
		}
	}

	/**
	 * 检测配置
	 */
	public function __isset($name){
		return isset($this->config[$name]);
	}

	/**
	 * 输出验证码
	 */
	 public function verify(){

	 	//验证码
	 	$code = $this->_Code();

	 	//创建验证码资源
	 	$this->image = imagecreate($this->config['width'], $this->config['height']);

	 	//验证码背景
	 	imagecolorallocate($this->image, $this->config['bgColor'][0], $this->config['bgColor'][1], $this->config['bgColor'][2]);

	 	$x = ($this->config['width'])/9;
	 	$y = ($this->config['height'])*0.9;
	 	$fontColor = imagecolorallocate($this->image, $this->config['fontColor'][0], $this->config['fontColor'][1], $this->config['fontColor'][2]);//验证码颜色

	 	//绘制验证码
	 	imagettftext($this->image, $this->config['fontSize'], $this->config['fontAngle'], $x, $y, $fontColor, $this->config['fontType'], $code);
	 	
	 	//绘制杂点
	 	$this->_Points();

	 	//保存验证码到SESSION
	 	$key = $this->_Secret($this->secretKey);
	 	$seVerify['code'] = $this->_Secret(strtoupper($code));
	 	$seVerify['createTime'] = time();
	 	$_SESSION[$key] = $seVerify;

	 	// 设置头部信息
	 	header('Cache-Control: private, max-age=0, no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header("content-type: image/png");

        // 输出图像
        imagepng($this->image);
        imagedestroy($this->image);

	 }

	 /**
	  * 判断验证码是否正确
	  */
	 public function check($code){

	 	$key = $this->_Secret($this->secretKey);

	 	if (empty($code)) {
	 		return false;
	 	}

	 	if (($this->config['expire'] + $_SESSION[$key]['createTime']) < time()) {
	 		unset($_SESSION[$key]);
	 		return false;
	 	}

	 	if ($this->_Secret(strtoupper($code)) == $_SESSION[$key]['code']) {
	 		return true;
	 	}

	 	return false;
	 }

	 /**
	  * 绘制杂点
	  */
	 private function _Points(){

	 	$stringPoints = 'abcdefghijklmnopqrstuvwxyzABCEDFGHIJKLMNOPQRSTUVWXYZ1234567890.*^&#';
	 	$pointFontColor = imagecolorallocate($this->image, $this->config['fontColor'][0], $this->config['fontColor'][1], $this->config['fontColor'][2]);

	 	for ($i=0; $i <16 ; $i++) { 
	 		imagestring($this->image, mt_rand(1,5), mt_rand(-10,$this->config['width']), mt_rand(-10,$this->config['height']), $stringPoints[mt_rand(0,strlen($stringPoints)-1)], $pointFontColor);
	 	}

	 }

	 /**
	  * 验证码
	  */
	 private function _Code(){
	 	$strlen = strlen($this->config['enText']) - 1;
	 	$verify_code = '';
	 	for ($i=0; $i < $this->config['count']; $i++) { 
	 		$verify_code .= $this->config['enText'][mt_rand(0,$strlen)];
	 	}
	 	return $verify_code;
	 }

	 /**
	  * 加密验证码
	  */
	 private function _Secret($code){
	 	$key = md5($this->config['secretKey']);
	 	return md5($key.md5($code));
	 }

}