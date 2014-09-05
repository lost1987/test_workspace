<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-22
 * Time: 下午5:16
 */

namespace process;


use interfaces\IProcess;

class TestQ implements IProcess{

    function execute()
    {
        // TODO: Implement execute() method.
        while(1){
            sleep(1);
        }
    }


} 