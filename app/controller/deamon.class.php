<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-19
 * Time: 下午4:48
 */

namespace app\controller;


use core\Base;

class Deamon extends Base{

      function index(){
          try{
            $this->tpl->assign('name','buhuan');
            $this->tpl->display('deamon.html');
          }catch (\Exception $e){
              echo $e->getMessage();
          }
      }

} 