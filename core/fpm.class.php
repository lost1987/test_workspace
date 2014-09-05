<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-18
 * Time: 下午4:54
 */

namespace core;


use interfaces\IStartup;

class Fpm implements IStartup{

    private static $_instance = null;


    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new Fpm();
        return self::$_instance;
    }

    function run($dir)
    {
        /*判断入口 根据入口解析pathinfo**/
        switch($dir){
           case  'admin' : list(,,$controller_name,$method_name) = explode('/',$_SERVER['PATH_INFO']);
                            break;

           case   'app'   :  list(,$controller_name,$method_name) = explode('/',$_SERVER['PATH_INFO']);
                            break;

             default:   die('dir is not regonized  in function run with php-fpm mode');
        }

        $http = Http::instance();
        $controller_name = '\\'.$dir.'\controller\\'.ucfirst($controller_name);

        /*检查类和方法是否存在 不存在则定位到404**/
        if(class_exists($controller_name)){
            $r = new ReflectClass($controller_name);
            $c =  $r -> newInstance() ;

            if(method_exists($c,$method_name)){
                    call_user_func(array($c,$method_name));
                    exit;
            }
        }

        $http->forward('/pages/404.html');
    }

} 