<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-7-29
 * Time: 下午2:37
 * memcache缓存类
 */

namespace core;


class Cache {

    private $host = null;

    private $port = null;

    private $resource = null;

    private static $_instance = null;

    private function __construct($config){
        $this->host = $config['host'];
        $this->port = $config['port'];

        $this->resource = memcache_connect($this->host,$this->port);
        if(!$this->resource)
            throw new \Exception('memcache连接失败');
    }

    /**
     * @param array $config  memcache配置项
     * @return Cache|null
     */
    static function instance($config){
        if(self::$_instance == null)
            self::$_instance = new Cache($config);
        return self::$_instance;
    }

    function getHost(){
        return $this->host;
    }

    function getPort(){
        return $this->port;
    }


    function cache($key,$data,$flag=false,$expire=0){
        $this->resource->set($key,$data,$flag,$expire);
    }

    function get($key,$flag=false){
        return $this->resource->get($key,$flag);
    }

    function close(){
        $this->resource->close();
    }

    function flush(){
        $this->resource->flush();
    }
} 