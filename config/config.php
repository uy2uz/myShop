<?php

/**
 * Файл настроек
 */
    //константы для обращения к контроллерам
    define('PathPrefix', '../controllers/');
    define('PathPostfix', 'Controller.php');
    
    //Настройки шаблонов
    
    //используемый шаблон
    $template = 'default';
    $templateAdmin = 'admin';
    
    //пути к файлам шаблонов (*.tpl)
    define ('TemplatePrefix', "../views/{$template}/");
    define ('TemplateAdminPrefix', "../views/{$templateAdmin}");
    define ('TemplatePostfix', '.tpl');
    
    //пути к файлам шаблонов в вебпространстве
    define ('TemplateWebPath', "/templates/{$template}/");
    define ('TemplateAdminWebPath', "/templates/{$templateAdmin}/");
    
    //Инициализация шаблона Smarty
    require('../library/Smarty/libs/Smarty.class.php');
    $smarty = new Smarty();
    
    $smarty->setTemplateDir(TemplatePrefix);
    $smarty->setCompileDir('../tmp/smarty/templates_c');
    $smarty->setCacheDir('../tmp/smarty/cache');
    $smarty->setConfigDir('../library/Smarty/configs');
    
    $smarty->assign('templateWebPath', TemplateWebPath);