<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-7-28
 * Time: 下午1:59
 */
class Autoload {

    static $folders = null;

    static function load($class_path){

            /*判断内部加载**/
            if(self::$folders == null)
                self::$folders = require(BASE_PATH.'/conf/autoload.inc.php');

            $class_name = preg_replace('/(.*)\\\\(.*)/','$2',$class_path);
            foreach(self::$folders as $folder_name){
                $file_path = BASE_PATH.'/'.$folder_name.'/'.lcfirst($class_name).'.class.php';
                if(file_exists($file_path))
                    require_once $file_path;
            }
    }

} 