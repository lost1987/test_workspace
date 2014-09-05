<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-26
 * Time: 下午7:03
 */

namespace core;


class Http {
         private static $_instance = null;


         static function instance(){
               if(self::$_instance == null)
                    self::$_instance = new Http();
             return self::$_instance;
         }

         function forward($url){
              header('location:'.$url);
         }

} 