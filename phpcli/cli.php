<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-7-28
 * Time: 下午1:11
 * php cli 模式运行入口
 */

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

define('BASE_PATH',dirname(dirname(__FILE__)));

require BASE_PATH.'/core/autoload.class.php';
require BASE_PATH.'/core/configure.class.php';
require BASE_PATH.'/core/db.class.php';
require BASE_PATH.'/core/base.class.php';
require BASE_PATH . '/omni.class.php';

$omni = Omni::instance();
$omni->run();