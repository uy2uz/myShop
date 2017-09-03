<?php
/* Smarty version 3.1.30, created on 2017-02-08 00:57:20
  from "C:\OpenServer\domains\myshop.local\views\default\product.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_589a42c0c752e2_44746508',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a56a0ca6b16b2a8f705a5fc4f09c116dd1710d5' => 
    array (
      0 => 'C:\\OpenServer\\domains\\myshop.local\\views\\default\\product.tpl',
      1 => 1486504622,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_589a42c0c752e2_44746508 (Smarty_Internal_Template $_smarty_tpl) {
?>


<h3><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['name'];?>
</h3>

<img width='575' src="/images/products/<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['image'];?>
">
Стоимость: <?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['price'];?>


<a id="removeCart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
" <?php if (!$_smarty_tpl->tpl_vars['itemInCart']->value) {?>class="hideme"<?php }?> href="#" onClick="removeFromCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
)"; return false; alt="Удалить из корзины">Удалить из корзины</a>
<a id="addCart_<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['itemInCart']->value) {?>class="hideme"<?php }?> href="#" onClick="addToCart(<?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['id'];?>
)"; return false; alt="Добавить в корзину">Добавить в корзину</a>
<p>Описание <br /><?php echo $_smarty_tpl->tpl_vars['rsProduct']->value['description'];?>
</p>
<?php }
}
