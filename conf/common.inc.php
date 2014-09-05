<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-4
 * Time: 下午2:13
 * 通用配置项
 */

return array(
    /***memcache 里存储的队列key*/
    'message_queue_keys' => array(
            1000, //测试队列key  key
    ),

    /*memcache 配置项**/
    'memcache' => array(
            'host' => '127.0.0.1',
            'port' => '11211'
     ),

    /*smarty配置项**/
    'smarty'   => array(
            'cache_enable' => false,
            'template_dir'  => '/template',
            'compile_dir' => '/template_c',
            'cache_dir'   => '/smarty_cache',
            'left_delimiter' => '{#',
            'right_delimiter' => '#}'
    ),

    /*自动初始化DB配置项 如果无需初始化DB 请留 '' **/
    'init_db' => 'deamon',

);