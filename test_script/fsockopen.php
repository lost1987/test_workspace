<?php
/**
 * Created by PhpStorm.
 * User: lost
 * Date: 14-8-12
 * Time: 下午6:22
 */
    $host = '192.168.162.134';
    $port = 2001;

    $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    socket_connect($socket,$host,$port);
    socket_set_nonblock($socket);//如果不设为非阻塞模式 那么socket_read在读取空数据后 将产生死锁

    socket_send($socket,$msg,strlen($msg),0);

    while($info=socket_read($socket,5)){
        $a .=  $info;
    }
    //echo $a;
    socket_close($socket);
    echo '连接已断开'.chr(10);