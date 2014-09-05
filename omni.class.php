<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-7-28
 * Time: 下午2:05
 * 统管启动执行类
 */
use core\Process;
use core\Configure;
use core\Cache;
use core\DB;
use core\Fpm;
use interfaces\IStartup;
class Omni {

       private $_config = null;

       private static  $_instance = null;

       private $_startup;

       private function __construct(){
           $this->base_init();
           $mode = php_sapi_name();
           switch($mode){
               case 'cli' :
                                    $this->cli_init();
                   break;

               default:        $this->fpm_init();
           }
       }

      static function instance(){
            if(self::$_instance == null)
                   self::$_instance = new Omni();
          return self::$_instance;
      }

    /**
     * 通用初始化
     */
    private function base_init(){
        spl_autoload_register(array('Autoload','load'));

        $this->_config = Configure::instance();
        $this->_config->load(array('common'));
        $this->cache = Cache::instance( $this->_config->common['memcache']);
    }


    private function cli_init(){
            $maps = require(BASE_PATH.'/conf/process.inc.php');
            $this->db = new DB('deamon');
            $this->_startup = Process::instance($maps);
    }


    private function fpm_init(){
            /*数据库初始化**/
            $init_db = $this->_config->common['init_db'] ;
            if(  $init_db != '' )
                $this->db = new DB($init_db);

            /*html模板初始化**/
            $this->tpl = new Smarty();
            $this->tpl->caching = $this->_config->common['smarty']['cache_enable'];
            $this->tpl->setTemplateDir(BASE_PATH . '/' .BASE_PROJECT . $this->_config->common['smarty']['template_dir']);
            $this->tpl->setCompileDir(BASE_PATH . '/' .BASE_PROJECT  . $this->_config->common['smarty']['compile_dir']);
            $this->tpl->setCacheDir(BASE_PATH . '/' .BASE_PROJECT  . $this->_config->common['smarty']['cache_dir']);
            $this->tpl->left_delimiter = $this->_config->common['smarty']['left_delimiter'];
            $this->tpl->right_delimiter = $this->_config->common['smarty']['right_delimiter'];

            /*运行pathinfo 解析**/
            $this->_startup = Fpm::instance();
    }


    /**
     * 执行 同一入口只运行一次
     * @param  string $dir 入口文件所在文件夹名称
     */
    function run($dir = null){
        if($this->_startup instanceof IStartup)
            $this->_startup->run($dir);
    }

}