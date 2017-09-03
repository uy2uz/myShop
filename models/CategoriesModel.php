<?php

/*
 *  
Модель для таблицы категорий (Categories)
 *  
 */
/**
 * Получить дочерние категории
 * @param type integer $catId ID категории
 */
function getChildrenForCat($catId) {
    $sql = "SELECT * 
           FROM categories
           WHERE parent_id = '$catId'";
    
    $rs = mysql_query ($sql);
    
    return createSmartyRsArray($rs);
    
}
/**
 * Получаем список категорий с привязкой к родительской
 * @return array массив категорий
 */
function getAllMainCatsWithCildren(){
    $sql = 'SELECT * 
           FROM categories
           WHERE parent_id = 0'; 
    $rs = mysql_query($sql);
    
    $smartyRs = array();
    while ($row = mysql_fetch_assoc($rs)) {
        $rsChildren = getChildrenForCat($row['id']);
        if ($rsChildren){
            $row ['children'] = $rsChildren;
        }
        
        $smartyRs[] = $row;
        
    }
        
        return $smartyRs;
}

/**
 *Получаем данные категории по id 
 * @param integer $catId - ID категории
 * @return type - строка категории (в массиве)
 */
function getCatById($catId){
    $catId = intval($catId);
    $sql = "SELECT *
           FROM categories
           WHERE
           id = '{$catId}'";
    $rs = mysql_query($sql);
    
    return mysql_fetch_assoc($rs);
}
/**
 * Получить все главные категории
 * 
 * @return array массив категорий
 */
function getAllMainCategories(){
    $sql = 'SELECT *
            FROM categories
            WHERE parent_id = 0';
    $rs = mysql_query($sql);
    
    return createSmartyRsArray($rs);
}
function  insertCat($catName, $catParentId = 0){
    $sql = "INSERT INTO
            categories (`parent_id`, `name`)
            VALUES ('{$catParentId}', '{$catName}')";
         
    mysql_query($sql);
    //получаем id добавленной категории
    $id = mysql_insert_id();
    
    return $id;
}
/**
 * Получить все категории
 * 
 * return array массив категорий
 */
function getAllCategories(){
    $sql = "SELECT *
            FROM categories
            ORDER BY parent_id ASC";
    $rs = mysql_query($sql);
    
    return createSmartyRsArray($rs);
}
/**
 * Обновление категорий
 * 
 * @param integer $itenId ID категории
 * @papram integer $parentId ID главной категории
 * @param string $newName
 * @return type
 */
function updateCategoryData($itemId, $parentId = -1, $newName = ''){
    $set = array();
    
    if($newName){
        $set[] = "`name` = '{$newName}'";
    }
    if($parentId >-1){
        $set[] = "`parent_id` = '{$parentId}'";
    }
    $setStr = implode($set, ", ");
    $sql = "UPDATE categories
            SET {$setStr}
            WHERE id = '{$itemId}'";
            
    $rs = mysql_query($sql);
    
    return $rs;
}