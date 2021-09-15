jQuery(document).ready(function () {

    $('.create_account').click(function(){
        $('.login-form').hide();
        $('.signup-form').show();
    });
    $('.sign-in').click(function(){
        $('.login-form').show();
        $('.signup-form').hide();
    });

    $(".signup-form").submit((e)=>{
        e.preventDefault();
        var form = $(".signup-form");
        var formData = new FormData(form[0]);
        formData.append('action','submit_signup_form');
        $('#message').html('');
        $.ajax({
            url: global_obj.ajaxUrl,
            type:'POST',
            data:formData,
            dataType:'JSON',
            contentType:false,
            cache:false,
            processData:false,
            success:function(res){
                if(res.status == 'true'){
                    $('#message').html(res.message);
                    window.location.href = res.url;
                
                }else{
                    $('#message').html(res.message);
                }
            }
        })
    });

    $(".login-form").submit((e)=>{
        e.preventDefault();
        var form = $(".login-form");
        var formData = new FormData(form[0]);
        formData.append('action','submit_login_form');
        $('#message').html('');
        $.ajax({
            url: global_obj.ajaxUrl,
            type:'POST',
            data:formData,
            dataType:'JSON',
            contentType:false,
            cache:false,
            processData:false,
            success:function(res){
                if(res.status == 'true'){
                    $('#message').html(res.message);
                    window.location.href = res.url;
                }else{
                    $('#message').html(res.message);
                }
            }
        })
    });
});