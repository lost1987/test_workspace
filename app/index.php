<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-18
 * Time: 下午4:23
 * fpm程序入口
 *
 */

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

define('BASE_PATH',dirname(dirname(__FILE__)));
define('BASE_PROJECT','app');

require BASE_PATH.'/core/autoload.class.php';
require BASE_PATH.'/core/configure.class.php';
require BASE_PATH.'/core/db.class.php';
require BASE_PATH.'/core/base.class.php';
require BASE_PATH.  '/libs/smarty/Smarty.class.php';
require BASE_PATH . '/omni.class.php';

$omni = Omni::instance();
$omni->run(BASE_PROJECT);
