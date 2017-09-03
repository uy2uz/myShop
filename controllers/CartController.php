<?php

/* 
 * CartController.php
 * 
 * Контроллер работы с корзиной (/cart/)
 *   
 */

//подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

/**
 * Добавляем товар в корзину
 * 
 * @return JSON rsData
 */
function  addtocartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if(!$itemId) return false;
    $resData = array();
    //если значение не найдено, то добавляем
    if(isset($_SESSION['cart']) && array_search($itemId, $_SESSION['cart'])=== false){
        $_SESSION['cart'][] = $itemId;
        $resData['cntItems'] = count($_SESSION['cart']);
        $resData['success'] = 1;
    }else{
        $resData['success'] = 0;
    }    
    echo json_encode($resData);
}

/**
 * Удаляем товар из корзины
 * 
 * @return JSON rsData
 */
function  removefromcartAction(){
    $itemId = isset($_GET['id']) ? intval($_GET['id']) : null;
    if(!$itemId) exit();
    $resData = array();
    $key = array_search($itemId, $_SESSION['cart']);
    if($key!==false){
     
    unset($_SESSION['cart'][$key]);
        $resData['success'] = 1;
        $resData['cntItems'] = count($_SESSION['cart']);
    }else{
        $resData['success'] = 0;
    }
    echo json_encode($resData);
}
/**
 * формируем страницу корзины
 * @link /cart/
 */
function indexAction($smarty){
 
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    
    $rsCategories = getAllMainCatsWithCildren();
    $rsProducts = getProductsFromArray($itemsIds);
    
    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'cart');
    loadTemplate($smarty, 'footer');
}
function  orderAction($smarty){
    $itemsIds = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
    // если корзина пуста, то редиректим в корзину
    if(! $itemsIds){
        redirect('/cart/');
        return;
    }
    $itemsCnt = array();
    foreach($itemsIds as $item){
        // формируем ключ для массива POST
        $postVar = 'itemCnt_' . $item;
        //создаем элемент массива количества покупаемого товара
        //ключ массива - ID товараб значение массива - количество товара
        // $itemCnt[1] = 3; товар с ID == 1 покупают 3 шт
        $itemsCnt[$item] = isset($_POST[$postVar]) ? $_POST[$postVar] : null;
    }
    $rsProducts = getProductsFromArray($itemsIds);
    //добавляем каждому продукту дополнительное поле
    //"realPrice" = количество продуктов умноженное на цену продукта
    //"cnt" = количество покупаемого товара
    //&$item - для того чтобы при изменении переменной $item  менялся и элемент массива $rsProducts
    $i = 0;
    foreach($rsProducts as &$item){
        $item['cnt'] = isset($itemsCnt[$item['id']]) ? $itemsCnt[$item['id']] : 0;
        if($item['cnt']){
            $item['realPrice'] = $item['cnt'] * $item['price'];
        }else{
            // если вдуг получилось так, что товар в корзине есть, а количество == 0
            // то удаляем этот товар
            unset($rsProducts[$i]);
        }
        $i++;
    }
    if(! $rsProducts){
        echo "Корзина пуста";
        return;
    }
    $_SESSION['saleCart'] = $rsProducts;
    
    $rsCategories = getAllMainCatsWithCildren();
    if(! isset($_SESSION['user'])){
        $smarty->assign('hideLoginBox', 1);
    }
    
    $smarty->assign('pageTitle', 'Заказ');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'order');
    loadTemplate($smarty, 'footer');
}

/**
 * AJAX функция сохранения заказа
 * 
 * @param array $_SESSION['saleCart'] массив покупаемых продуктов
 * @return json информация о результатах выполнения
 */
function saveorderAction(){
    $cart = isset($_SESSION['saleCart']) ? $_SESSION['saleCart'] : null;

    //если корзина пуста, то формируем ответ с ошибкой, отдаем
    //его в формате json и выходим из функции
    if(!$cart){
        $resData['success'] = 0;
        $resData['message'] = 'Ваша корзина пуста, невозможно оформить заказ!';
        echo json_encode($resDate);
        return;
    }
    $name   = $_POST['name'];
    $phone  = $_POST['phone'];
    $adress = $_POST['adress'];
    //создаем новый заказ, получаем его Id
    $orderId = makeNewOrder($name, $phone, $adress);
    // если заказ не создан, то выводим ошибку и завершаем функцию
    if(! $orderId){
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка создания заказа';
        echo json_encode($resData);
        return;
    }
    // сохраняем товары для созданного заказа
    $res = setPurchaseForOrder($orderId, $cart);
    //если успешно, то формируем ответ, удаляем переменные корзины
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Заказ сохранен!';
        unset($_SESSION['saleCart']);
        unset($_SESSION['cart']);
    }else{
        $resData['success'] = 0;
        $resData['message'] = 'Ошибка внесения данных заказа № ' . $orderId;
    }
    
    echo json_encode($resData);
    
}
