<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

include "order.php";

$myOrder2 = Order::getOrderById2(1);

if(!empty($myOrder2->rpo)) {
    $rpo = $myOrder2->rpo;
}
else { $rpo = "хз"; }



echo "Ваш заказ: <br><br>
      ШПИ:$rpo <br>
      Стоимость товара: $myOrder2->productCost <br>
      Стоимость доставки: $myOrder2->deliveryCost <br>
      Статус заказа: $myOrder2->orderStatus <br>
      <br>
      Полная стоимость заказа: ";

echo $myOrder2->fullCost();