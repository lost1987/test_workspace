<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-5
 * Time: 下午2:57
 * 基于PDO:MYSQL的数据库操作类
 */

namespace core;


class DB {

    private $_resouce = null;
    private $_host = null;
    private $_user = null;
    private $_passwd = null;
    private $_port = null;
    private $_stmt = null;

    function __construct($dbname){
        $this->init_db($dbname);
    }

    private function init_db($dbname){
        $config = Configure::instance();
        $config->load('db');

        $this->_host = $config->db[$dbname]['host'];
        $this->_user = $config->db[$dbname]['user'];
        $this->_passwd = $config->db[$dbname]['passwd'];
        $this->_port = $config->db[$dbname]['port'];

        $this->_resouce = new \PDO("mysql:host=$this->_host;dbname=$dbname",$this->_user,$this->_passwd);
        if(!$this->_resouce)
            throw new \Exception('can not connect host '.$this->_host);
    }

    /**
     * 设置PDO选项
     * @param int $pdo_attr  PDO属性 PDO::
     * @param bool  $val
     * @return $this
     */
    function setOptions($pdo_attr,$val){
            $this->_resouce->setAttribute($pdo_attr,$val);
            return $this;
    }

    /**
     * @param $sql
     * @param array $params
     * @return $this
     */
    function execute($sql,$params=null){
            $this->_stmt = $this->_resouce->prepare($sql);
            return $this->_stmt->execute($params);
     }

    /**
     * 简单的执行sql
     * @param $sql
     * @return $this
     */
    function simple_exec($sql){
            $this->_resouce->exec($sql);
            return $this;
    }


    /**
     * @param int $style
     * @return mixed
     */
    function fetch($style = \PDO::FETCH_ASSOC){
            return $this->_stmt->fetch($style);
    }

    /**
     * @param int $style
     * @return mixed
     */
    function fetch_all($style = \PDO::FETCH_ASSOC){
            return $this->_stmt->fetchAll($style);
    }


    function insert_id(){
            return $this->_resouce->lastInsertId();
    }


    function begin(){
            $this->_resouce->beginTransaction();
            return $this;
    }


    function commit(){
            $this->_resouce->commit();
            return $this;
    }

    function rollback(){
            $this->_resouce->rollBack();
            return $this;
    }


    function close(){
            $this->_resouce = null;
    }

    function change($dbname){
            $this->close();
            $this->init_db($dbname);
    }

} 