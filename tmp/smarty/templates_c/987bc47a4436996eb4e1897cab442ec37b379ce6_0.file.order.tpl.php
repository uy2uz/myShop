<?php
/* Smarty version 3.1.30, created on 2017-04-03 00:14:25
  from "C:\OpenServer\domains\myshop.local\views\default\order.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58e169b1ec5ea8_66351250',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '987bc47a4436996eb4e1897cab442ec37b379ce6' => 
    array (
      0 => 'C:\\OpenServer\\domains\\myshop.local\\views\\default\\order.tpl',
      1 => 1491167649,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58e169b1ec5ea8_66351250 (Smarty_Internal_Template $_smarty_tpl) {
?>

<h2>Данные заказа</h2>
<form id="frmOrder" action="/cart/saveorder/" method="POST">
    <table>
        <tr>
            <td>№</td>
            <td>Наименование</td>
            <td>Количество</td>
            <td>Цена за еденицу</td>
            <td>Стоимость</td>
        </tr>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rsProducts']->value, 'item', false, NULL, 'products', array (
  'iteration' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']++;
?>
            <tr>
                <td><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_products']->value['iteration'] : null);?>
</td>
                <td><a href="/product/<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</a></td>
                <td>
                    <span id="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
}">
                        <input type="hidden" name="itemCnt_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['cnt'];?>
"/>
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['cnt'];?>

                    </span>
                </td>
                <td>
                    <span id="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
}">
                        <input type="hidden" name="itemPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>
"/>
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['price'];?>

                    </span>
                </td>
                <td>
                    <span id="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_id']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_id']->value['index'] : null)];?>
}">
                        <input type="hidden" name="itemRealPrice_<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['item']->value['realPrice'];?>
"/>
                        <?php echo $_smarty_tpl->tpl_vars['item']->value['realPrice'];?>

                    </span>
                </td>
            </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>
    
    </table>
    <?php if (isset($_smarty_tpl->tpl_vars['arUser']->value)) {?>
        <?php $_smarty_tpl->_assignInScope('buttonClass', '');
?>
        <h2>Данные заказчика</h2>
        <div id="orderUserIfoBox" <?php echo $_smarty_tpl->tpl_vars['buttonClass']->value;?>
>
            <?php $_smarty_tpl->_assignInScope('name', $_smarty_tpl->tpl_vars['arUser']->value['name']);
?>
            <?php $_smarty_tpl->_assignInScope('phone', $_smarty_tpl->tpl_vars['arUser']->value['phone']);
?>
            <?php $_smarty_tpl->_assignInScope('adress', $_smarty_tpl->tpl_vars['arUser']->value['adress']);
?>
            <table>
                <tr>
                    <td>Имя*</td>
                    <td><input type="text" id="name" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"></td>
                </tr>
                <tr>
                    <td>Телефон*</td>
                    <td><input type="text" id="phone" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
"></td>
                </tr>
                <tr>
                    <td>Адрес*</td>
                    <td><textarea id="adress" name="adress"><?php echo $_smarty_tpl->tpl_vars['adress']->value;?>
</textarea></td>
                </tr>
            </table>
        </div>
    <?php } else { ?>
        <div id="loginBox">
            <div class="menuCaption">Авторизация</div>
            <table>
                <tr>
                    <td>Логин</td>
                    <td><input type="text" id="loginEmail" name="loginEmail" value=""/></td>
                </tr>
                <tr>
                    <td>Пароль</td>
                    <td><input type="password" id="loginPwd" name="loginPwd" value=""/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="button" onclick="login();" value="Войти"/></td>
                </tr>
            </table>
        </div>
        <div id="registerBox">
            <div class="menuCaption">Регистрация нового пользователя</div>
            email* :<br />
            <input type="text" id="email" name="email" value=""/><br />
            пароль* :<br />
            <input type="password" id="pwd1" name="pwd1" value=""/><br />
            повторить пароль* :<br />
            <input type="password" id="pwd2" name="pwd2" value=""/><br />
            Имя* :<input type="text" id="name" name="name" value=""/><br />
            Телефон* :<input type="text" id="phone" name="phone" value=""/><br />
            Адрес* :<textarea id="adress" name="adress"/></textarea><br />
            <input type="button" onclick="registerNewUser();" value="Зарегистрироваться"/>
        </div>
    <?php $_smarty_tpl->_assignInScope('buttonClass', "class='hideme'");
?>    
    <?php }?>
    <input id="btnSaveOrder" <?php echo $_smarty_tpl->tpl_vars['buttonClass']->value;?>
 type="button" value="Оформить заказ" onclick="saveOrder();"/>
</form><?php }
}
