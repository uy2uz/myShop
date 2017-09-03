<?php

/* 
 * Модель пользователей
 */
/**
 * 
 * Регистрация нового пользователя
 *
 * @param string $email
 * @param string $pwdMD5
 * @param string $name
 * @param string $phone
 * @param string $adress
 */
function registerNewUser($email, $pwdMD5, $name, $phone, $adress){
    $email  = htmlspecialchars(mysql_real_escape_string($email));
 // $pwdMD5 = htmlspecialchars(mysql_real_escape_string($pwdMD5));
    $name   = htmlspecialchars(mysql_real_escape_string($name));
    $phone  = htmlspecialchars(mysql_real_escape_string($phone));
    $adress = htmlspecialchars(mysql_real_escape_string($adress));
    $sql = "INSERT INTO
            users(`email`, `pwd`, `name`, `phone`, `adress`)
            VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$adress}')";
    $rs = mysql_query($sql);
    
    if($rs){
        $sql = "SELECT * FROM users
                WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}')
                LIMIT 1";
        $rs = mysql_query($sql);
        $rs = createSmartyRsArray($rs);
        
        if (isset($rs[0])){
            $rs['success'] = 1;
        }else{
            $rs['success'] = 0;
        }
    }else{
        $rs['success'] = 0;
    }
    
    return $rs;
}
 
 /**
  * 
  * @param string $email
  * @param string $pwd1
  * @param string $pwd2  
*/
 function checkRegisterParams ($email, $pwd1, $pwd2) {
     $res = null;
             
     if(! $email){
         $res['success'] = false;
         $res['message'] = 'Введите email';
     }
     if(! $pwd1){
         $res['success'] = false;
         $res['message'] = 'Введите пароль';
     }
     if(! $pwd2){
         $res['success'] = false;
         $res['message'] = 'Повторите пароль';
     }
      if($pwd1 != $pwd2){
         $res['success'] = false;
         $res['message'] = 'Пароли не совпадают';
     }
     return $res;
 }

function checkUserEmail($email){
    $email = mysql_real_escape_string($email);
    $sql = "SELECT id FROM users WHERE `email` = '{$email}'";
    
    $rs = mysql_query($sql);
    
    $rs = createSmartyRsArray($rs);
    
    return $rs;
}

function loginUser($email, $pwd){
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $pwd = trim($pwd);
    $pwd = md5($pwd);
        
    $sql = "SELECT * FROM users
            WHERE (`email` = '{$email}' and `pwd` = '{$pwd}')
            LIMIT 1";
    
    $rs = mysql_query($sql);
    $rs = createSmartyRsArray($rs);
    if(isset($rs[0])){
        $rs['success'] = 1;
    }else{
        $rs['success'] = 0;
    }
    
    return $rs;        
}

/**
 * 
 * @param string $name имя пользователя
 * @param string $phone телефон пользователя
 * @param string $adress адрес пользователя
 * @param string $pwd1 новый пароль
 * @param string $pwd2 повтор нового пароля
 * @param string $curPwd текущий пароль
 */
function  updateUserData($name, $phone, $adress, $pwd1, $pwd2, $curPwd){
    $email  = htmlspecialchars(mysql_real_escape_string($_SESSION['user']['email']));
    $name   = htmlspecialchars(mysql_real_escape_string($name));
    $phone  = htmlspecialchars(mysql_real_escape_string($phone));
    $adress = htmlspecialchars(mysql_real_escape_string($adress));
    $curPwd = htmlspecialchars(mysql_real_escape_string($curPwd));
    $pwd1 = trim($pwd1);
    $pwd2 = trim($pwd2);
    $curPwd = trim($curPwd);
    
    $newPwd = null;
    if ($pwd1 && ($pwd1 == $pwd2)){
        $newPwd = md5($pwd1);
    }
    
    $sql = "UPDATE users
            SET ";
    if($newPwd){
        $sql .= "`pwd` = '{$newPwd}', ";
    }
    $sql .= " `name`   = '{$name}',
              `phone`  = '{$phone}',
              `adress` = '{$adress}'
        WHERE
              `email` = '{$email}' AND `pwd` = '{$curPwd}'
        LIMIT 1";
           
    $rs = mysql_query($sql);  
     
    return $rs;
}

/**
 * Получить данные заказа текущего пользователя
 * 
 * @return array массив заказов с привязкой к продуктам
 */
function getCurUserOrders(){
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
    $rs = getOrdersWithProductsByUser($userId);
    return $rs;
}