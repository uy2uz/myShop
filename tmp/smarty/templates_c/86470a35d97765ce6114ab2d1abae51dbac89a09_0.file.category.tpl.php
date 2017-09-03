<?php
/* Smarty version 3.1.30, created on 2017-01-29 03:09:27
  from "C:\OpenServer\domains\myshop.local\views\default\category.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_588d32b79ca2f8_14733775',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86470a35d97765ce6114ab2d1abae51dbac89a09' => 
    array (
      0 => 'C:\\OpenServer\\domains\\myshop.local\\views\\default\\category.tpl',
      1 => 1485647555,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_588d32b79ca2f8_14733775 (Smarty_Internal_Template $_smarty_tpl) {
?>
<h1><?php echo $_smarty_tpl->tpl_vars['rsCategory']->value['name'];?>
 приманки</h1>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']++;
?>
        <div style="float: left; padding: 0px 30px 40px 0px;">
            <a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/">
                <img src="/images/products/<?php echo $_smarty_tpl->tpl_vars['item']->value['image'];?>
" width="100" />
            </a><br />
        </div>
        <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] : null) % 3 == 0) {?>
            <div style="clear: both"></div>
        <?php }?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
    
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsChildCats']->value, 'item', false, NULL, 'childCats', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
        <h2><a href="/category/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</h2>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}
}
