<?php
/**
 * Created by PhpStorm.
 * User: 卜峘
 * Date: 14-8-15
 * Time: 下午5:19
 * linux脚本操作类 分支 : CENTOS6.5
 */

namespace core;


class ShTool {

    private static $_instance = NULL;

    private $_command = NULL;

    private $_script_grep = NULL;

    private $_script_awk = NULL;

    private $_script = NULL;

    private $_result = NULL;

    static function instance(){
            if(self::$_instance == NULL){
                     self::$_instance = new ShTool();
            }
            return self::$_instance;
    }

    /**
     * 设置脚本命令
     * @param  string  $command
     */
    function setCommand($command){
        $this->_command = $command;
        return $this;
    }

    /**
     * 设置过滤命令
     * @param string $grep
     */
    function setGrep($grep){
        $this->_script_grep = ' grep '.$grep;
        return $this;
    }

    /**
     * 设置awk 命令
     * @param string $awk
     */
    function setAwk($awk){
        $this->_script_awk =  ' awk '.$awk;
        return $this;
    }

    /**
     * 建立脚本语句
     */
    function  build(){
        $script = null;

        if(empty($this->_command))
            throw new \Exception('command is null');

        $script[] = $this->_command;

        if(!empty($this->_script_grep))
            $script[] = $this->_script_grep;

        if(!empty($this->_script_awk))
            $script[] = $this->_script_awk;

        $this->_script = implode(' | ',$script);
        return $this;
    }

    /**
     * 得到完整的脚本语句
     * @return string
     */
    function fetch_script(){
             return $this->_script;
    }

    /**
     * 执行语句 并返回语句的输出内容
     * @param null $script linux脚本命令 如果指定为null 则直接执行该语句 否则执行内置变量_script的脚本内容
     * @param null &$stat  linux脚本命令的返回值
     * @return array  返回执行语句的输出内容数组(一个元素为输出内容的一行)
     */
    function execute($script = null,&$stat=null){
             if($script == null)
                    exec($this->_script,$this->_result,$stat);
             else
                    exec($script,$this->_result,$stat);

             return $this->_result;
    }

    /**
     * 清空所有变量值
     */
    function flush_var(){
        $reflect = new ReflectClass($this);
        $reflect->setPropertiesNull(ReflectProperty::IS_NON_STATIC,$this);
    }


    /**
     * 根据pid杀死进程
     * @param $pid
     * @return mixed
     */
    function kill($pid){
            $command = "kill -9 $pid";
            exec($command,$result,$stat);
            return $stat;
    }

    /**
     * 根据进程名杀死进程
     * @param $name
     * @return mixed
     */
    function pkill($name){
            $command = "pkill -9 $name";
            exec($command,$result,$stat);
            return $stat;
    }

} 