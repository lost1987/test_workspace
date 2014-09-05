<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-7-29
 * Time: 下午2:19
 */
namespace core;

class Encoder {

    const MSGPACK = 1;
    const JSON = 2;


    private static $_instance = null;

    function __construct(){}

    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new Encoder();
        return self::$_instance;
    }

    /**
     * @param $data   string|array
     * @param int $type 默认为JSON
     * @return null|string|array
     * @throws \Exception
     */
    function encode($data,$type = Encoder::JSON){
        $handler_data = null;
        switch($type){
            case 1 :
                $handler_data =  msgpack_pack($data);
                break;

            case 2 :
                $handler_data =  json_encode($data);
                break;
        }

        if($handler_data == null)
            throw new \Exception('Encode:数据打包失败');
        return $handler_data;
    }

    /**
     * @param $encoded_data string
     * @param int $type  默认为json 并且json格式解包为数组
     * @return array|string|null
     * @throws \Exception
     */
    function decode($encoded_data,$type = Encoder::JSON){
        $handler_data = null;
        switch($type){
            case 1 :
                $handler_data =  msgpack_unpack($encoded_data);
                break;

            case 2 :
                $handler_data =  json_decode($encoded_data,true);
                break;
        }

        if($handler_data == null)
            throw new \Exception('Encode:数据解包失败');
        return $handler_data;
    }

} 