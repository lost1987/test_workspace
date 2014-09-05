<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-7-28
 * Time: 下午2:22
 */

namespace core;


use interfaces\IStartup;

class Process extends Base implements  IStartup{

    /**
     * 进程映射
     * @var null
     */
    private  $maps = null;

    /**
     * 进程的ID数组
     * @var null
     */
    private  $pids = null;

    /**
     * Shell 类
     * @var null
     */
    private  $shell = null;


    private static $_instance = null;


    private function __construct($maps){
         if(!function_exists('exec'))
             throw new \Exception('exec已经禁用! 请配置相关选项');

         $this->maps = $maps;
         $this->shell = ShTool::instance();
    }

    static function instance($maps){
            if(self::$_instance == null)
                self::$_instance = new Process($maps);
            return self::$_instance;
    }

    function run($dir=null)
    {
        /**
         * 清理所有进程日志,清理所有php守护进程
         */
        $this->clear();

        foreach($this->maps as $class_name => $params){
                $pid = pcntl_fork();
                if($pid == -1){
                    throw new \Exception('无法创建子进程');
                }else if($pid == 0){
                    $ppid = getmypid();
                    $this->save_db_log($ppid,$class_name);
                    $this->pids[]  = $ppid;
                    $class_name='process\\'.$class_name;
                    $object = new $class_name;
                    $object->execute();
                    posix_kill($ppid,SIGTERM);
                }
               else{
                   //父进程中
                   //pcntl_wait($status);//如果需要同时进行多个进程 请注释此行 因为会导致父进程阻塞
               }
               usleep(10000);
        }
        /**
         * 关闭父进程db 因为子进程中已经无法使用该DB
         */
        $this->db->close();
    }

    private function save_db_log($pid,$name,$type='ep_pol'){
            $time = time();
            $sql = "INSERT INTO php_process (pid,name,type,create_time) VALUES ($pid,'$name','$type',$time)";
            if(!$this->db->execute($sql)){
                $this->shell->kill($pid);
                throw new \Exception('进程日志记录错误');
            }
    }


    private function clear(){
         $sql = "SELECT pid,name FROM php_process";
         $this->db->execute($sql);
         $deamons = $this->db->fetch_all();
         foreach($deamons as $d){
               $this->shell->kill($d['pid']);
         }

        $sql = 'truncate php_process';
        $this->db->execute($sql);
    }

}