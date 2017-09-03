<?php

/* 
Модель для таблицы продукции
 * 
 * 
 */

function getLastProducts($limit = null){
    $sql = "SELECT *
           FROM products
           ORDER BY id DESC";
    if ($limit){
        $sql .= " LIMIT {$limit}";
    }
    
    $rs = mysql_query($sql);
    
    return createSmartyRsArray($rs);
}

/**
 * Получить продукты для категории $itemId
 *  * 
 * @param integer $itemId ID категории
 * @return array массив продуктов
 */
function getProductsByCat($itemId){
    $itemId = intval($itemId);
    $sql = "SELECT *
           FROM products
           WHERE category_id = '{$itemId}'";
           
    $rs = mysql_query($sql);
    
    return createSmartyRsArray($rs);
    
}
/**
 * Получить данные продукта по ID
 * 
 * @param integer $itemId - ID продукта
 * @return array массив данных продукта
 */
function getProductsById($itemId){
    $itemId = intval($itemId);
    $sql = "SELECT *
           FROM products
           WHERE id = '{$itemId}'";
       
    $rs = mysql_query($sql);
      
    return mysql_fetch_assoc($rs);
 }
 
function getProductsFromArray($itemsIds){
     $strIds = implode($itemsIds, ', ');
     
     $sql = "SELECT *
           FROM products
           WHERE id in({$strIds})";
        
    $rs = mysql_query($sql);
     
     return createSmartyRsArray($rs);
 }
function getProducts(){
    $sql = "SELECT *
            FROM `products`
            ORDER BY category_id";
    $rs= mysql_query($sql);
    
    return createSmartyRsArray($rs);
 }
/**
* Добавление нового продукта в БД

* @param string $itemName Название товара
* @param integer $itemPrice Цена
* @param string $itemDesc Описание
* @param integer $itemCat ID категории
* @return type
*/
function insertProduct($itemName, $itemPrice, $itemDesc, $itemCat){
    $sql = "INSERT INTO products
            SET
               `name`        = '{$itemName}',
               `price`       = '{$itemPrice}',
               `description` = '{$itemDesc}',
               `category_id` = '{$itemCat}'";
             
    $rs = mysql_query($sql);
    return $rs;
 }
 /**
  * Сохранение изменений в карточке товара (админка)
  * 
  * @param integer $itemId ID товара
  * @param string $itemName название товара
  * @param integer $itemPrice цена товара
  * @param boolean $itemStatus статус вывода на сайт
  * @param string $itemDesc описание товара
  * @param integer $itemCat ID  категории товара
  * @param string $newFileName ссылка на фото
  * @return type
  */
 function updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat, $newFileName = null){
    $set = array();
     
    if($itemName){
        $set[] = "`name` = '{$itemName}'";
    }
     
    if($itemPrice > 0){
        $set[] = "`price` = '{$itemPrice}'";
    }
     
    if($itemStatus !== null){
        $set[] = "`status` = '{$itemStatus}'";
    }
    
    if($itemDesc){
        $set[] = "`description` = '{$itemDesc}'";
    }
    
    if($itemCat){
        $set[] = "`category_id` = '{$itemCat}'";
    }
     
    if($newFileName){
        $set[] = "`image` = '{$newFileName}'";
    }
     
    $setStr = implode($set, ", ");
    $sql = "UPDATE products
            SET {$setStr}
            WHERE id = '{$itemId}'";
           
    $rs = mysql_query($sql);
    return $rs;
 }
 function updateProductImage($itemId, $newFileName){
    $rs = updateProduct($itemId, null, null, null, null, null, $newFileName);
    return $rs;
 }
 
   
function updateCountProduct($countProduct, $itemId){
    $sql = "UPDATE products
            SET
               `countproduct` = '{$countProduct}'
                WHERE id = '{$itemId}'";
                
    $rs = mysql_query($sql);
    return $rs;
}