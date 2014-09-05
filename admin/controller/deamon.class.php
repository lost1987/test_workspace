<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-19
 * Time: 下午4:48
 */

namespace admin\controller;


use core\Base;

class Deamon extends Base{

      function index(){
            $sql = "select * from php_process";
            $this->db->execute($sql);
            $result = $this->db-> fetch_all();
            $this->tpl->assign('deamons',$result);
            $this->tpl->display('deamon.html');
      }

} 