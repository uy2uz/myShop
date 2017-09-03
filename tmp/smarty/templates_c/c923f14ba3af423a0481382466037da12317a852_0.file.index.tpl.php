<?php
/* Smarty version 3.1.30, created on 2017-02-05 13:40:07
  from "C:\OpenServer\domains\myshop.local\views\default\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58970107c181f7_15157068',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c923f14ba3af423a0481382466037da12317a852' => 
    array (
      0 => 'C:\\OpenServer\\domains\\myshop.local\\views\\default\\index.tpl',
      1 => 1486291202,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58970107c181f7_15157068 (Smarty_Internal_Template $_smarty_tpl) {
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
" width="100"/>
        </a><br />
        <a href = "/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"/><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a>
    </div>
    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] : null) % 3 == 0) {?>
        <div style="clear: both;"></div>
    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

           
<?php }
}
