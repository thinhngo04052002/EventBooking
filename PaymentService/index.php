<?php
require_once ("./controller/callMoMoAPI.php");

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('payment', true, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    //Message nhận được từ queue
    echo ' [x] Received message: ', $msg->body, "\n";
    $controller = new callMoMoAPI();
    $data = json_decode($msg->body, true);
    $controller->processPostData($data);
};

$channel->basic_consume('payment', '', false, true, false, false, $callback);

try {
    $channel->consume();
} catch (\Throwable $exception) {
    echo $exception->getMessage();
}