<?php
/**
 * Модель для таблицы (purchase)
 */

/**
 * Внесение в базу данных продуктов с привязкой к заказу
 *
 * @param integer $orderId ID заказа
 * @param $cart массив корзины
 * @return boolean TRUE в случае успешного добавления в БД
 */
function  setPurchaseForOrder($orderId, $cart){
    $sql = "INSERT INTO purchase
           (order_id, product_id, price, amount)
           VALUES ";
    $values = array();
    
    foreach ($cart as $item){
        $values[] = "('{$orderId}', '{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }
    $sql .= implode($values, ', ');
   
    $rs = mysql_query($sql);
    return $rs;
}
function getPurchaseForOrder($orderId){
    $sql = "SELECT `pe`.*, `ps`.`name`
            FROM purchase as `pe`
            JOIN products as `ps` ON `pe`.product_id = `ps`.id
            WHERE `pe`.order_id = {$orderId}";
            //d($sql);
            $rs = mysql_query($sql);
            return createSmartyRsArray($rs);
}