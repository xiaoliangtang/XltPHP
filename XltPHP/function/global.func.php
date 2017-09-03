<?php
/**
 * 打印函数
 */
function p($value='')
{
	echo '<pre>';
	print_r($value);
	echo '<pre>';
}

/**
 * 获取或者设置配置值
 */
function config($type='global', $name=null, $value=null)
{
	if (is_null($name)) {
		exit('参数有误!');
	}
	$config_file = CONFIG . '/config_'. $type .'.php';

	if (is_null($value)) {
		// 获取配置值
		$configs = require $config_file;
		return $configs[$name];
	} else {
		// 设置配置值
		$configs = require $config_file;
		$configs[$name] = $value;
		$configs_str = '';

		foreach ($configs as $k => $v) {
			$configs_str .= '\''.$k.'\''.'=>'.'\''.$v.'\''.',';
		}

		$configs_content = '<?php return array('. $configs_str .');?>';

		file_put_contents($config_file, $configs_content);

	}
	
}