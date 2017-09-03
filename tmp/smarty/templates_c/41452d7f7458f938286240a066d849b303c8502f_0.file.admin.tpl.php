<?php
/* Smarty version 3.1.30, created on 2017-04-18 23:08:15
  from "C:\OpenServer\domains\myshop.local\views\admin\admin.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58f6722f565f71_10847052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41452d7f7458f938286240a066d849b303c8502f' => 
    array (
      0 => 'C:\\OpenServer\\domains\\myshop.local\\views\\admin\\admin.tpl',
      1 => 1492546085,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58f6722f565f71_10847052 (Smarty_Internal_Template $_smarty_tpl) {
?>

        <div id="blockNewCategory">
            Новая категория
            <input name="newCategoryName" id="newCategoryName" type="text" value="" />
            <br />
            
            Является подкатегорией для
            <select name="generalCatId">
                <option value="0">Главная категория
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsCategories']->value, 'item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>

                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>    
            <br />
            <input type="button" onclick="newCategory();" value="Добавить категорию"/>
        </div>
<?php }
}
