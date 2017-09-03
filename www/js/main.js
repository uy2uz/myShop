
function addToCart(itemId){
    console.log("js - addToCart()");
    $.ajax({
        type: 'POST',
        async: false,
        url: "/cart/addtocart/" + itemId +'/',
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
                
                $('#addCart_'+ itemId).hide();
                $('#removeCart_'+ itemId).show();
            }
        }
    });
}
function removeFromCart(itemId){
    console.log("js - removeFromCart()");
    $.ajax({
        type: 'POST',
        async: false,
        url: "/cart/removefromcart/" + itemId +'/',
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#cartCntItems').html(data['cntItems']);
                
                $('#addCart_'+ itemId).show();
                $('#removeCart_'+ itemId).hide();
            }
        }
    });
}
/**
* РџРѕРґСЃС‡РµС‚ СЃС‚РѕРёРјРѕСЃС‚Рё РєСѓРїР»РµРЅРѕРіРѕ С‚РѕРІР°СЂР°
* @param integer itemId ID РїСЂРѕРґСѓРєС‚Р°
*/
function conversionPrice(itemId){
    var newCnt = $('#itemCnt_' + itemId).val();
    var itemPrice = $('#itemPrice_' + itemId).attr('value');
    var itemRealPrice = newCnt * itemPrice;
    
    $('#itemRealPrice_' + itemId).html(itemRealPrice);
}

/**
* Р¤СѓРЅРєС†РёСЏ СЃР±РѕСЂР° РґР°РЅРЅС‹С… СЃ С„РѕСЂРјС‹ СЂРµРіРёСЃС‚СЂР°С†РёРё
* 
* @param {type} obj_form
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


/**
* С„СѓРЅРєС†РёСЏ СЂРµРіРёСЃС‚СЂР°С†РёРё РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ 
*/
function registerNewUser(){
    var postData = getData('#registerBox','#userLink');
        $.ajax({
        type: 'POST',
        async: false,
        url: "/user/register/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                alert(data['message']);
                $('#registerBox').hide();
                $('#loginBox').hide();
                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['userName']);
                $('#userBox').show();
                               
                $('#btnSaveOrder').show();
                
                
            }else{
                  alert(data['message']);
            }
        }
    });
}

/**
* Р’С‹С…РѕРґ РёР· Р°РєРєР°СѓРЅС‚Р°
*/
function logout(){
    console.log('Logout');    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/logout/",
        
        success: function(){
            console.log('user logged out');
            $('#registerBox').show();
            $('#userBox').hide();
        }
    });
}

/**
* Р¤СѓРЅРєС†РёСЏ Р°РІС‚РѕСЂРёР·Р°С†РёРё РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ
*/
function login(){
    var email = $('#loginEmail').val();
    var pwd   = $('#loginPwd').val();
    
    var postData = "email=" + email + "&pwd=" +pwd;
    
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/login/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#registerBox').hide();
                
                
                $('#userLink').attr('href', '/user/');
                $('#userLink').html(data['displayName']);
                $('#userBox').show();
                $('#loginBox').hide();
                
                //>Р·Р°РїРѕР»РЅСЏРµРј РїРѕР»СЏ РЅР° СЃС‚СЂР°РЅРёС†Рµ Р·Р°РєР°Р·Р°
                $('#name').val(data['name']);
                $('phone').val(data['phone']);
                $('adress').val(data['adress']);
                //<
                $('#btnSaveOrder').show();
            }else{
                alert(data['message']);
            }
        }
    });
}

/**
* РџРѕРєР°Р·Р°С‚СЊ РёР»Рё СЃРїСЂСЏС‚Р°С‚СЊ С„РѕСЂРјСѓ СЂРµРіРёСЃС‚СЂР°С†РёРё
*/
function showRegisterBox(){
    if( $("#registerBoxHidden").css('display') != 'block'){
        $("#registerBoxHidden").show();
    }else{
        $("#registerBoxHidden").hide();
    }
}

/**
* РћР±РЅРѕРІР»РµРЅРёСЏ РґР°РЅРЅС‹С… РїРѕР»СЊР·РѕРІР°С‚РµР»СЏ
*/
function updateUserData(){
    console.log("js - updateUserData()");
    var phone  = $('#newPhone').val();
    var adress = $('#newAdress').val();
    var pwd1   = $('#newPwd1').val();
    var pwd2   = $('#newPwd2').val();
    var curPwd = $('#curPwd').val();
    var name   = $('#newName').val();
    
    var postData = {phone: phone,
                    adress: adress,
                    pwd1: pwd1,
                    pwd2: pwd2,
                    curPwd: curPwd,
                    name: name};
    $.ajax({
        type: 'POST',
        async: false,
        url: "/user/update/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#userLink').html(data['userName']);
                alert(data['message']);
            }else{
                alert(data['message']);
            }
        }
        
    });            
}
function saveOrder() {
    var postData = getData('form');
    $.ajax({
        type: 'POST',
        async: false,
        url: "/cart/saveorder/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                document.location.href = '/';
                alert(data['message']);
            }else{
                alert(data['message']);
            }
        }
    });
}

function showProducts(id){
    var objName = "#purchasesForOrderId_" + id;
    if($(objName).css('display') != 'table-row'){
        $(objName).show();
    }else{
        $(objName).hide();
    }    
}