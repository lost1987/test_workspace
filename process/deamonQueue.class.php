<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-4
 * Time: 下午1:38
 * linux消息队列守护进程
 */

namespace process;

use core\BaseProcess;
use core\Configure;
use core\Queue;
use interfaces\IProcess;
use utils\Tools;

class deamonQueue extends BaseProcess implements  IProcess{

    /**
     * 每隔多少秒 执行一次操作
     */
    const TICKET = 0.001;

    function  __construct(){
            if(!Tools::check_extension_is_on('ev'))
                throw new \Exception('ev extension is not loaded');
    }

    function execute()
    {

        /**
         * 实例化DB
         * 因为是子进程 所以不能使用之前实例化的DB 否则mysql has gone away
         */
        $this->load_db('deamon');

        $config = Configure::instance();
        $config -> load('common');
        //读取队列key
        $data['keys'] = $config->common['message_queue_keys'];
        //清空消息队列
        $this->removeQueues($data['keys']);
        $evTimer = new \EvTimer(1,self::TICKET,array($this,'readQueue'),$data);
        \ev::run();
    }


    function removeQueues($keys){
            foreach($keys as $key){
                Queue::instance()->setKey($key)->getQueue()->removeQueue();
            }
    }

    function readQueue($watcher){
            $keys = $watcher->data['keys'];

            foreach($keys as $key){
                switch($key){
                    case 1000:  $this->test();
                }
            }

    }

    function test(){
           $data = Queue::instance() -> setKey(1000) -> getQueue() -> getMessage();
           if(!empty($data['message']))
               $this->db->simple_exec("insert into test  (click) values ('{$data['message']}') ");
    }

}