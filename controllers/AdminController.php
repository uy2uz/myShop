<?php

/**
 * AdminController.php
 * 
 * Контроллер бекенда сайта (/admin/)
 */
// подключение моделей
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

$smarty->setTemplateDir(TemplateAdminPrefix);
$smarty->assign('templateWebPath',TemplateAdminWebPath);


function indexAction($smarty){
    
    $rsCategories = getAllMainCategories();
    
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('pageTitle', 'Управление сайтом');
    
    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'admin');
    loadTemplate($smarty, 'adminFooter');
}
function addnewcatAction(){
    $catName     = $_POST['newCategoryName'];
    $catParentId = $_POST['generalCatId'];
    
    
    $res = insertCat($catName, $catParentId);
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Категория добавлена';
    }else{
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка при добавлении категории';
    }
    echo json_encode($resData);
    return;
}

/**
 * Страница управления категориями
 * 
 * @param type $smarty
 */
function categoryAction($smarty){
    $rsCategories = getAllCategories();
    $rsMainCategories = getAllMainCategories();
    
    
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsMainCategories', $rsMainCategories);
    $smarty->assign('pageTitle', 'Управление сайтом');
    
    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminCategory');
    loadTemplate($smarty, 'adminFooter');
}
function updatecategoryAction(){
    $itemId   = $_POST['itemId'];
    $parentId = $_POST['parentId'];
    $newName  = $_POST['newName'];
    
    $res = updateCategoryData($itemId, $parentId, $newName);
      
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Категория обновлена';
    }else{
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка обновления категории';
    }
    echo json_encode($resData);
    return;
}
function productsAction($smarty){
    $rsCategories = getAllCategories();
    $rsProducts = getProducts();
    
    
    
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    
    $smarty->assign('pageTitle', 'Управление сайтом');
    
    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminProducts');
    loadTemplate($smarty, 'adminFooter');
}
function addProductAction(){
    $itemName  = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemDesc  = $_POST['itemDesc'];
    $itemCat   = $_POST['itemCatId'];
    
    
    $res = insertProduct($itemName, $itemPrice, $itemDesc, $itemCat);
    
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Товар добавлен';
    }else{
        $resData['success'] = 0;
        $resData['Ошибка добавления товара'];
    }
    echo json_encode($resData);
    return;
}
function updateproductAction(){
    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemStatus = $_POST['itemStatus'];
    $itemDesc = $_POST['itemDesc'];
    $itemCat = $_POST['itemCatId'];
    
    
    $res = updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat);
    
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Изменения внесены успешно';
    }else{
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка изменения данных';
    }
    echo json_encode($resData);
    return;
}
function uploadAction(){
    $maxSize = 2*1024*1024;
    
    $itemId = $_POST['itemId'];
    //получаем расширение загружаемого файла
    $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
    //создаем имя файла
    $newFileName = $itemId . '.' . $ext;
    
    if($_FILES["filename"]["size"] > $maxSize){
        echo ("Размер файла превышает 2Мб");
        return;
    }
    //проверяем факт закгрузки файла
    if(is_uploaded_file($_FILES['filename']['tmp_name'])){
        //если файл загружен, то перемещаем его из временной директории в директорию хранения файлов
        $res= move_uploaded_file($_FILES['filename']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/images/products/' . $newFileName);
        if($res){
            $res = updateProductImage($itemId, $newFileName);
            if($res){
                redirect('/admin/products/');
            }
        }
    }else{
        echo("Ошибка загрузки файла");
    }
}

//формирование страницы закаов
function ordersAction($smarty){
    $rsOrders = getOrders();
    
    $smarty->assign('rsOrders', $rsOrders);
    $smarty->assign('pageTitle', 'Заказы');
    
    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminOrders');
    loadTemplate($smarty, 'adminFooter');
}
function setordersatusAction(){
    $itemId = $_POST['itemId'];
    $status = $_POST['status'];
   
    $res = updateOrderStatus($itemId, $status);
    
    if($res){
        $resData['success'] = 1;
    }else{
        $resData['succes'] = 0;
        $resData['message'] = "Ошибка установки статуса";
    }
    echo json_encode($resData);
    return;
}
function setorderdatepaymentAction(){
    $itemId = $_POST['itemId'];
    $datePayment = $_POST['datePayment'];
    
    $res = updateOrderDatePayment($itemId, $datePayment);
    
    if($res){
        $resData['success'] = 1;
    }else{
        $resData['success'] = 0;
        $resData['message'] = "Ошибка о отметке даты оплаты";
    }
    echo json_encode($resData);
    return;
}
function setcountproductAction($itemId){
    
    $itemId = $_POST['itemId'];
    $addCountProduct = $_POST['itemAddCountProduct'];
    $product = getProductsById($itemId);
    $countProduct = intval($product['countproduct']) + $addCountProduct;
    $res = updateCountProduct($countProduct, $itemId);
    
    if($res){
        $resData['success'] = 1;
        $resData['message'] = "Товар добавлен";
        
    }else{
        $resData['success'] = 0;
        $resData['message'] = "Ошибка добавления товара";
    }
    echo json_encode($resData);
    return;   
}
