<?php

/* 
 * ProductController.php
 * 
 * Контроллер страницы товаров 
 *  
 */

include_once '../models/ProductsModel.php';
include_once '../models/CategoriesModel.php';

function indexAction ($smarty){
    $itemId = isset($_GET['id']) ? $_GET['id'] : null;
    if($itemId == nul) exit ();
    
    //получаем данные продукта
    $rsProduct = getProductsById($itemId);
    
    //получаем все категории
    $rsCategories = getAllMainCatsWithCildren();
    
    $smarty->assign('itemInCart', 0);
    if(in_array($itemId, $_SESSION['cart'])){
        $smarty->assign('itemInCart', 1);
    }
     
    $smarty->assign('pageTitle','');
    $smarty->assign('rsCategories',$rsCategories);
    $smarty->assign('rsProduct',$rsProduct);
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'product');
    loadTemplate($smarty, 'footer');
}
