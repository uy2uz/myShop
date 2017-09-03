<h2>Заказы</h2>
{if !$rsOrders}
    Нет заказов
{else}
    <table border="1" cellpadding="1" cellspacing="1">
        <tr>
            <th>№</th>
            <th>Действие</th>
            <th>ID заказа</th>
            <th width="100">Статус</th>
            <th>Дата создания</th>
            <th>Дата оплаты</th>
            <th>Дополнительная информация</th>
            <th>Дата изменения заказа</th>
        </tr>        
    
    {foreach $rsOrders as $item name=orders}
        <tr>
            <td>{$smarty.foreach.orders.iteration}</td>
            <td><a href="#" onclick="showProductsAdmin('{$item['id']}'); return false;">показать товар заказа</a></td>
            <td>{$item['id']}</td>
            <td>
                <input type="checkbox" id="itemStatus_{$item['id']}" {if $item['status']}checked="checked"{/if} onclick="updateOrderStatus('{$item['id']}');"/> Закрыт
            </td>
            <td>{$item['date_created']}</td>
            <td>
                <input id="datePayment_{$item['id']}" type="text" value="{$item['date_payment']}"/>
                <input type="button" value="Сохранить" onclick="updateDatePayment('{$item['id']}');"/>
            </td>
            <td>{$item['comment']}</td>
            <td>{$item['date_modification']}</td>
        </tr>
        <tr class="hideme" id="purchasesForOrderId_{$item['id']}">
            <td colspan="8">
                {if $item['children']}
                    <table border="1" cellpadding="1" cellspacing="1" width="100%">
                        <tr>
                            <th>№</th>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Запас продукта</th>
                            <th>возможность продажи</th>
                        </tr>
                    {foreach $item['children'] as $itemChild name=products}
                        <tr>
                            <td>{$smarty.foreach.products.iteration}</td>
                            <td>{$itemChild['id']}</td>
                            <td><a href="/product/{$itemChild['id']}/">{$itemChild['name']}</a></td>
                            <td>{$itemChild['price']}</td>
                            <td>{$itemChild['amount']}</td>
                            <td>{$itemChild['countproduct']}</td>
                            <td>
                                {if $itemChild['amount'] > $itemChild['countproduct']}
                                    no
                                {else}
                                    yes
                                {/if}
                            </td>
                        </tr>
                    {/foreach}    
                    </table>
                {/if}    
            </td>
        </tr>
    {/foreach}
    </table>
{/if}    