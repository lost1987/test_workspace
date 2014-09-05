<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-18
 * Time: 下午5:14
 */

echo $_SERVER['REQUEST_URI'];
exit;
$str = 'http://192.168.162.134/process/kkk';

$preg = '/http:\/\/(.*?\/)(.*)/';

$s = preg_replace($preg,'http://$1app/index.php/$2',$str);

echo $s;