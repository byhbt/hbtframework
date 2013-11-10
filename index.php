<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

//Define path and constant
$base_path = realpath(dirname(__FILE__));

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', $base_path . DS);
define('APP_PATH', BASE_PATH . 'application' . DS);
define('SYS_PATH', BASE_PATH . 'system' . DS);
define('CONFIG_PATH', APP_PATH . 'config' . DS); //locate in application folder
define('CONTROLLER_PATH', APP_PATH . 'controller' . DS);
define('MODEL_PATH', APP_PATH . 'model' . DS);
define('LIBRARY_PATH', APP_PATH . 'library' . DS);

require(CONFIG_PATH . 'config.php');
require(SYS_PATH . 'loader.php');
require(SYS_PATH . 'bootstrap.php');

//Autoload classes
$paths = array(SYS_PATH, APP_PATH, CONTROLLER_PATH, MODEL_PATH, LIBRARY_PATH);

$loader = new Loader($paths);
$loader->init();

$helper = new Helper();
$helper->load_helper(array('html_helper', 'crypto_helper', 'misc_helper', 'recaptcha_helper'));

//Bootstrap - Handle URL Requests
$app = new Bootstrap();
