<?php
/**
 * Контроллер главной страницы
 */  
    //подключение модели CategoriesModel
    
    include_once '../models/CategoriesModel.php';
    include_once '../models/ProductsModel.php';

    function testAction(){
        echo 'IndexController.php > testAction';
    }

    /**
     * Формирование главной страницы сайта
     * 
     */
    function indexAction($smarty){
        
        $rsCategories = getAllMainCatsWithCildren();
        
        $rsProducts = getLastProducts(16);
        
        
        $smarty->assign('pageTitle', 'Главная страница сайта');
        $smarty->assign('rsCategories', $rsCategories);
        $smarty->assign('rsProducts', $rsProducts);
        
        loadTemplate($smarty, 'header');
        loadTemplate($smarty, 'index'); 
        loadTemplate($smarty, 'footer'); 
    }