<?php

/* 
 Контроллер страницы категории
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';

/**
 * формирование страницы категорий
 * 
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty){
    $catId = isset($_GET['id']) ? $_GET['id'] : null;
    if($catId == null) exit();
    
    $rsCategory = null;
    $rsProducts = null;
        
    $rsCategory = getCatById($catId);
    
    if ($rsCategory['parent_id'] == 0){
        $rsChildCats = getChildrenForCat($catId);
    }else{
        $rsProducts = getProductsByCat($catId);
    }

    $rsCategories = getAllMainCatsWithCildren();
    
    $smarty->assign('pageTitle', 'Товары категории' . $rsCategory['name']);
    $smarty->assign('rsCategory', $rsCategory);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsChildCats', $rsChildCats);
    
    $smarty->assign('rsCategories', $rsCategories);
 
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'category');
    loadTemplate($smarty, 'footer');
}