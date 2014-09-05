<?php

$message_queue_key = 1000;

$message_queue = msg_get_queue($message_queue_key, 0777);
//var_dump($message_queue);

$message_queue_status = msg_stat_queue($message_queue);
//print_r($message_queue_status);

//向消息队列中写入 100次 应该是即时完成 然后守护进程会每秒去读一次数据
for($i =0 ; $i < 10000 ; $i++){
msg_send($message_queue, 1, "call $i test you !");
}