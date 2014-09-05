<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-7-28
 * Time: 下午4:48
 */

namespace core;


abstract class Base {

   function __get($property){
       global $omni;
       return  $omni -> $property;
   }

} 