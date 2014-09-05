<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-4
 * Time: 下午2:20
 * 配置文件的读取类 [conf\]
 */

namespace core;


class Configure {

        private  static $_instance = null;

        /**
         * 配置项 数组
         * @var null
         */
        private $data = null;

        private function __construct(){}

        /**
         * @param $filename  array|string
         */
        function load($filename){
                    if(is_array($filename)){
                            foreach($filename as $name){
                                 $temp = require(BASE_PATH.'/conf/'.$name.'.inc.php');
                                 $this->data[$name] = $temp;
                            }
                    }else{
                            $this->data[$filename] = require(BASE_PATH.'/conf/'.$filename.'.inc.php');
                    }
            }

        static function instance(){
                if(self::$_instance == null)
                    self::$_instance = new Configure();
                return self::$_instance;
        }

        function __get($property){
            return $this->data[$property];
        }
} 