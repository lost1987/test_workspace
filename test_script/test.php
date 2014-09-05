<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-9-1
 * Time: 上午2:59
 */
class a{

    static function who(){
        echo __CLASS__.chr(10);
    }

    static function foo(){
          static ::who();
    }

}


class b extends  a{

    static function test(){
          a::foo();
          parent::foo();
          self::foo();
    }

    static function who(){
         echo __CLASS__.chr(10);
    }



}


class c extends b{
    static function who(){
        echo __CLASS__.chr(10);
    }
}

c::test();