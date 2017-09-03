<?php
    
/**
* Основные функции
*/

    /**
     * Формирование запрашиваемой страницы
     * 
     * @param type $controllerName - название контроллера
     * @param type $actionName - название функции обработки страницы
     */
    function loadPage($smarty, $controllerName, $actionName = 'index'){
        include_once PathPrefix . $controllerName . PathPostfix;
        //формируем название функции
        $function = $actionName . 'Action';
        $function($smarty);
    }
    /**
     * Загрузка шаблона
     * 
     * @param type $smarty - объект шаблонизатора
     * @param type $templateName - название файла шаблона
     */
    function loadTemplate($smarty, $templateName){
        $smarty->display($templateName . TemplatePostfix);
    }
    
    /**
     * Функция отладки
     * 
     * @param type $value - переменная отладки
     * @param type $die - остановка скрипта
     */
    function d($value = null, $die = 1){
        echo 'Debug: <br /><pre>';
        print_r($value);
        echo '</pre>';
        
        if($die) die;
    }
    /**
     * функция переобразование результатов работы функции выборки в ассоциативный массив
     * @param type $rs набор строк - результат работы SELECT
     * @return array выборка в массиве
     */
    function createSmartyRsArray($rs) {
        if (! $rs) return FALSE;
        
        $smartyRs = array();
        while ($row = mysql_fetch_assoc($rs)) {
            $smartyRs[] = $row;
        }
        
        return $smartyRs;
    }
    
    /**
     * Функция редирект
     * @param string $url адрес для перенаправления
     */
    function redirect($url){
        if(!url) $url = '/';
        header("Location: {$url}");
        exit;
    }