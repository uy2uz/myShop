<?php

/* 
 *Инициализация подключения к БД
 * 
 */

$dblocation = "127.0.0.1";
$dbname = "myshop";
$dbuser = "root";
$dbpasswd = "";

//соеденение с БД
$db = mysql_connect($dblocation, $dbuser, $dbpasswd);

if (! $db){
    echo "Ошибка доступа к MySQL";
    exit();
}

// Установка кодировки для декущего соеденения с БД
mysql_set_charset('utf-8');

    if (! mysql_select_db($dbname, $db)) {
    echo "Ошибка доступа к базе данных! {$dbname}";
    exit();
    }