$(document).ready(function () {
    $('#subscription').on('click', function (e) {

        $.ajax({
            url: "http://localhost/otata/public/subscription",
            type: "GET",
            dataType: "json",
            success: function(data) {
                    $('#sub_price, #total_sub, #total_sub2').html(data.object.subscription_price);
                    $('#subprice, #totalprice').val(data.object.subscription_price);
            }
        });
    });

    $('#sub_quantity').bind('keyup mouseup', function () {
        var subprice =  $('#subprice').val();
        var quantity = $(this).val();
        var total = subprice*quantity;
        total=total.toFixed(2);
        $('#total_sub, #total_sub2').html(total);
        $('#totalprice').val(total);
    });

    $('#btn-renew').on('click', function (e) {
        var sub_quantity=$('#sub_quantity').val();
        var subprice=$('#totalprice').val();
        var token=$('#subscription-form #_token').val();
        var name = $('#subscription-form #name').val();
        var email = $('#subscription-form #email').val();
        var phone = $('#subscription-form #phone').val();
        var userid = $('#subscription-form #userid').val();

        $.ajax({
            url: "http://localhost/otata/public/subscription/renew",
            data:{
                "_token"    : token,
                "subprice"  : subprice,
                "name"     : name,
                "userid"    : userid,
                "email"     : email,
                "sub_quantity" : sub_quantity,
                "phone"     : phone
            },
            type: "POST",
            dataType: "json",
            success: function(data) {
                if(data.message != 'success'){
                    var errors = data;
                    $.each(errors, function(index, sm){
                        toastr.error(sm, {timeOut: 5000});
                    });
                }else{
                    window.location.href= data.object;
                }
            }
        });
    });
    
});