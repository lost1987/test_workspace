<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-9-4
 * Time: 下午6:58
 */

namespace core;


abstract class BaseProcess {
      protected  function load_db($db_name){
          $this->db = new DB($db_name);
      }
}