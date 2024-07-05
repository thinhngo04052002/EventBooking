<?php

require_once __DIR__ . '../../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class sendUrlthanhtoan
{
    public function sendUrlthanhtoan($data)
    {

        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('urlthanhtoan', true, true, false, false);

        $msg = new AMQPMessage(json_encode($data));
        $channel->basic_publish($msg, '', 'urlthanhtoan');

        echo " [x] Sent message successfully'\n";

        $channel->close();
        $connection->close();
    }
}