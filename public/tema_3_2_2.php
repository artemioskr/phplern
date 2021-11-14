<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include "tema_3_2.php";

$method  = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
//$input = json_decode(file_get_contents('php://input'),true);

if($method != 'POST') {
    http_response_code(400);
    echo "POST";
} else {
    if (count($request) != 1) {
        http_response_code(400);
        echo "Указывай только один id";
    } else {
        http_response_code(200);
        $order  = RussianPostOrder::getOrderById($request[0]);
        $result = [
            'rpo'          => $order->rpo,
            'deliveryCost' => $order->deliveryCost,
            'productCost'  => $order->productCost,
            'status'       => $order->orderStatus,
            'full_sum'     => $order->fullCost()
        ];

        echo json_encode($result);
    }
}
