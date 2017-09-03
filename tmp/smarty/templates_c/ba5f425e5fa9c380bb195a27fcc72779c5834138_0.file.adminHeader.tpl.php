<?php
/* Smarty version 3.1.30, created on 2017-04-17 19:58:53
  from "C:\OpenServer\domains\myshop.local\views\admin\adminHeader.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58f4f44d02b8e4_06218816',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ba5f425e5fa9c380bb195a27fcc72779c5834138' => 
    array (
      0 => 'C:\\OpenServer\\domains\\myshop.local\\views\\admin\\adminHeader.tpl',
      1 => 1492448327,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:adminLeftColumn.tpl' => 1,
  ),
),false)) {
function content_58f4f44d02b8e4_06218816 (Smarty_Internal_Template $_smarty_tpl) {
?>

<html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
css/main.css" type="text/css" />
        <?php echo '<script'; ?>
 type="text/javascript" src="/js/jquery-1.7.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
js/admin.js"><?php echo '</script'; ?>
>
    </head>
    
    <body>
        <div id="header">
            <h1>Управление сайтом</h1>
        </div>
        <?php $_smarty_tpl->_subTemplateRender("file:adminLeftColumn.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    
        <div id="centerColumn">    
        <?php }
}
