<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-4
 * Time: 下午1:29
 * linux 队列处理
 */

namespace core;


class Queue{

    private static $_instance = null;

    private $_message_queue_key = null;

    private $_message_queue = null;

    static function instance(){
        if(self::$_instance == null)
            self::$_instance = new Queue();
        return self::$_instance;
    }

    /**
     * 设置队列键
     * @param int $key
     * @return $this
     * @throws \Exception
     */
    function setKey($key){
        $this->_message_queue_key = $key;
        $config  = Configure::instance();
        $config->load('common');
        $message_queue_keys = $config->common['message_queue_keys'];
        if(!in_array($key,$message_queue_keys))
            throw new \Exception('invalid message queue key');
        return $this;
    }

    /**
     * 获取队列
     * @return $this
     */
    function getQueue(){
        $this->_message_queue = \msg_get_queue($this->_message_queue_key,0666);
        return $this;
    }

    /**
     * 发送消息
     * @param $data
     * @param int $msg_type
     * @param bool $serialize
     * @param bool $blocking
     * @return mixed
     */
    function send($data,$msg_type=1,$serialize=true,$blocking=true){
        $return_data['success'] = 1;
        $return_data['errcode'] = 0;
        if(!\msg_send($this->_message_queue,$msg_type,$data,$serialize,$blocking,$errcode)){
            $return_data['errcode'] = $errcode;
            $return_data['success']  = 0;
        }
        return $return_data;
    }

    /**
     * 从指定队列得到消息
     * @param int $len
     * @param bool $unserialize
     * @param int $flags
     * @return mixed
     */
    function getMessage($len=1024,$unserialize=true,$flags=MSG_IPC_NOWAIT){
           \msg_receive($this->_message_queue,0,$msg_type,$len,$message,$unserialize,$flags,$errcode);
            $data['msg_type'] = $msg_type;
            $data['message'] = $message;
            $data['errcode']  = $errcode;
            return $data;
    }

    /**
     * 移除队列
     * @param $key
     */
    function removeQueue(){
            \msg_remove_queue($this->_message_queue);
    }

} 