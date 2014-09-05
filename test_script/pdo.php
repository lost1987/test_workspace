<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-5
 * Time: 下午2:32
 */

$_resource = new \PDO("mysql:host=127.0.0.1;dbname=deamon",'root','root');
for($i =0 ; $i< 100 ; $i++){
$_resource -> exec("insert into test(click) values ('fdsffewfw')");
}