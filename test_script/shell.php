<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-15
 * Time: 下午4:00
 */



//exec(' ps -el | grep "php" | awk \'$11=="ep_pol" {print $4}\' ',$a);
//var_dump($a);
define('PATH',dirname(dirname(__FILE__)));

require PATH.'/core/reflectProperty.class.php';
require PATH.'/core/reflectClass.class.php';
require PATH.'/core/shtool.class.php';

use core\ShTool;
$sh = ShTool::instance();
$result = $sh->setCommand('ps -el')
                      ->setGrep(' "php" ')
                      ->setAwk(' \'$11=="ep_pol" {print $4}\' ')
                      ->build()
                      // ->fetch_script();
                      ->execute();



