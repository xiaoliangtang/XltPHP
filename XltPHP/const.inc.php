<?php
/**
 * 路径常量
 */
define('CORE', ROOT.'/XltPHP');
define('LIB', CORE.'/library');
define('FUNC', CORE.'/function');

/**
 * 应用常量
 */
define('APP_NAME', 'App');
define('ADMIN_NAME', 'Admin');
define('HOME_NAME', 'Home');
define('APP_PATH', ROOT.'/'.APP_NAME);
define('ADMIN_PATH', APP_PATH.'/'.ADMIN_NAME);
define('HOME_PATH', APP_PATH.'/'.HOME_NAME);
define('ADMIN_CONTROLLER_PATH', ADMIN_PATH.'/controllers');
define('HOME_CONTROLLER_PATH', HOME_PATH.'/controllers');
define('ADMIN_VIEW_PATH', ADMIN_PATH.'/views');
define('HOME_VIEW_PATH', HOME_PATH.'/views');
define('CONFIG',APP_PATH.'/Config');