<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * todo описать с помощью классов и наследования разные типы заказов, иерархия:
 *                      Заказ
 *                     /     \
 *        Почтовый заказ      Заказ курьерки
 *                             /           \
 *                        Заказ сдека     Заказ беты
 *
 * todo #1 Заказ (Order) должен содержать данные
 *  [
 *    стоимость товара
 *    стоимость доставки
 *    статус
 *  ]
 *  и иметь метод который посчитает общую сумму (товар + доставка)
 *
 * todo #2 Почтовый заказ (RussianPostOrder) должен еще содержать RPO (ШПИ) и стоимость тарифа почты россии
 *  и метод расчета общей суммы должен прибавлять еще и этот тариф
 *
 * todo #3 Заказ курьерки (CurierDeliveryServiceOrder) должен содержать некий delivery_service_id (идентификатор заказа в самой курьерке)
 *
 * todo #4 Заказ сдека
 *  отличается от заказа курьерки только тем, что
 *
 * todo #4 Заказ беты
 *  отличается от заказа курьерки только тем, что
 *
 * todo #??? Все типы заказов должны уметь описывать себя неким методом, допустим describe, который возвращает строку
 *  с инфой что это за заказ, на какую сумму и какой статус
 */

$orders = [
    '1' => [100,200,'delivered',123456],
    '2' => [200,100,'send',324256]
];

const ORDERS = [
    '1' => [100,200,'delivered',123456],
    '2' => [200,100,'send',324256]
];

class Order {

    const ORDERS = [
        '1' => [100,200,'delivered',123456],
        '2' => [200,100,'send']
    ];

    public $productCost;
    public $deliveryCost;
    public $orderStatus;

    public function __construct($productCost, $deliveryCost, $orderStatus)
    {
        $this->productCost  = $productCost;
        $this->deliveryCost = $deliveryCost;
        $this->orderStatus  = $orderStatus;
    }

    public function fullCost()
    {
        return $this->productCost + $this->deliveryCost;
    }

    public static function getOrderById2($id) {
        $order = Order::ORDERS[$id];
        if (!empty($order[3])) {
            return new RussianPostOrder($order[0], $order[1],$order[2],$order[3]);
        } else {
            return new Order($order[0],$order[1],$order[2]);
        }
    }

}

class RussianPostOrder extends Order {

    public $rpo;

    public function __construct($productCost, $deliveryCost, $orderStatus, $rpo)
    {
        parent::__construct($productCost,$deliveryCost,$orderStatus);
        $this->rpo = $rpo;
    }

    public static function getOrderById($id) { // вот шо это, куда пихнуть? если в класс рашн пост, то как из под него себя же дергать?
        $order = RussianPostOrder::ORDERS[$id];
        return new RussianPostOrder($order[0],$order[1],$order[2],$order[3]); // как это сделать красиво?
    }

}

//function getOrderById($id) { // вот шо это, куда пихнуть? если в класс рашн пост, то как из под него себя же дергать?
//    $order = RussianPostOrder::ORDERS[$id];
//    return new RussianPostOrder($order[0],$order[1],$order[2],$order[3]); // как это сделать красиво?
//}





