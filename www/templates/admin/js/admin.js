/**
 * Получение данных с формы
 */
function getData(obj_form){
    var hData = {};
    $('input, textarea, select', obj_form).each(function(){
        if(this.name && this.name != ''){
            hData[this.name] = this.value;
            console.log('hData[' + this.name + '] = ' + hData[this.name]);
        }
    });
    return hData;
};

function newCategory(){
    var postData = getData('#blockNewCategory');
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/addnewcat/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#newCategoryName').val('');
            }else{
                alert(data['message']);
            }
        }
        
    });
}
function updateCat(itemId){
    var parentId = $('#parentId_' + itemId).val();
    var newName = $('#itemName_' + itemId).val();
    var postData = {itemId: itemId, parentId: parentId, newName: newName};
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/updatecategory/",
        data: postData,
        dataType: 'json',
        success: function(data){
                    alert(data['message']);
        }
    });
}
function addProduct(){
    var itemName  = $('#newItemName').val();
    var itemPrice = $('#newItemPrice').val();
    var itemCatId = $('#newItemCatId').val();
    var itemDesc  = $('#newItemDesc').val();
    
    var postData = {itemName: itemName, itemPrice: itemPrice, itemCatId: itemCatId, itemDesc: itemDesc};
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/addproduct/",
        data: postData,
        dataType: 'json',
        success: function(data){
            alert(data['message']);
            if(data['success']){
                $('#newItemName').val('');
                $('#newItemPrice').val('');
                $('#newItemCatId').val('');
                $('#newItemDesc').val('');
            }
        }
    });
}

function updateProduct(itemId){
    var itemName = $('#itemName_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).val();
    var itemCatId = $('#itemCatId_' + itemId).val();
    var itemDesc = $('#itemDesc_' + itemId).val();
    var itemStatus = $('#itemStatus_' + itemId).attr('checked');
    if(! itemStatus){
        itemStatus = 1;
    }else{
        itemStatus = 0;
    }
    
    var postData = {itemId: itemId, itemName: itemName, itemPrice: itemPrice, itemCatId: itemCatId, itemDesc: itemDesc, itemStatus: itemStatus};
    
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/updateproduct/",
       data: postData,
       dataType: 'json',
       success: function(data){
           alert(data['message']);
       }
    });
}
function showProductsAdmin(id){
    var objName1 = "#purchasesForOrderId_" + id;
    if($(objName1).css('display') != 'table-row'){
        $(objName1).show();
    }else{
        $(objName1).hide();
    }    
};

function updateOrderStatus(itemId){
    var status = $('#itemStatus_' + itemId).attr('checked');
    if(! status){
        status = 0
    }else{
        status = 1
    }
    
    var postData = {itemId: itemId, status: status};
    
    $.ajax({
       type: 'POST',
       async: false,
       url: "/admin/setordersatus/",
       data: postData,
       dataType: 'json',
       success: function(data){
            if(!data['success']){
                alert(data['message']);
            }
        }
    });
}
function updateDatePayment(itemId){
    var datePayment = $('#datePayment_' + itemId).val();
    var postData = {itemId: itemId, datePayment: datePayment};
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/setorderdatepayment/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(! data['success']){
                alert(data['message'])
            }
        }
    });
}

function addCountProduct(itemId){
    
    var itemAddCountProduct = $('#itemAddCountProduct_' + itemId).val();
    var postData = {itemId: itemId, itemAddCountProduct: itemAddCountProduct};
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/admin/setcountproduct/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                alert(data['message']);
                
            }
        }
    });
}
function reCntItems(itemId){
    
    var cntItems = $('#cntItems_' + itemId).html();
    var itemAddCountProduct = $('#itemAddCountProduct_' + itemId).val();
    var reCntItems = 1*(cntItems) + 1*(itemAddCountProduct);
    
    $('#cntItems_' + itemId).html(reCntItems);
    $('#itemAddCountProduct_' + itemId).val('');
}    