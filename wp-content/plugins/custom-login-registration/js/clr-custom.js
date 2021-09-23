
jQuery('.clr-login-from button.clr_login_btn').click(function(e){
    e.preventDefault();
    var username = jQuery('form input[name="clr_user_login"]').val();
    var password  = jQuery('form input[name="clr_user_password"]').val();

    if (username.length == 0 ){
        jQuery('form input[name="clr_user_login"]').addClass('input-error');
    }else{
        jQuery('form input[name="clr_user_login"]').removeClass('input-error');
    }
    if (password.length == 0 ){
        jQuery('form input[name="clr_user_password"]').addClass('input-error');
    }else{
        jQuery('form input[name="clr_user_password"]').removeClass('input-error');
    }

    if (username.length == 0 || password.length == 0){
        return false;
    }else{
        user_loginFrm();       
    }
});

jQuery('.clr-register-from button.clr_reg_btn').click(function(e){
    e.preventDefault();
    user_registerFrm();
});



function user_loginFrm(){
	jQuery('#clr_loader').show();
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: clr_ajax_object.ajax_url,
        data: { 
            'action': 'clr_ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
            'username'  : jQuery('form input[name="clr_user_login"]').val(),
            'password'  : jQuery('form input[name="clr_user_password"]').val(),
            'rememberme': jQuery('form input[name="clr_rememberme"]').val()},            
        success: function(data){
        	jQuery('#clr_loader').hide();
        	if (data.loggedin == true){
        		jQuery('form#clr_login_form .clr_response_msg').show();
                jQuery('form#clr_login_form .clr_response_msg .alert').addClass('alert-success');
                jQuery('form#clr_login_form .clr_response_msg .alert').text(data.message);
        		jQuery('form#clr_login_form .clr_response_msg').delay(1000).fadeOut();
                location.reload();
            }else{
                jQuery('form#clr_login_form .clr_response_msg').show();
                jQuery('form#clr_login_form .clr_response_msg .alert').addClass('alert-error');
                jQuery('form#clr_login_form .clr_response_msg .alert').text(data.message);
                jQuery('form#clr_login_form .clr_response_msg').delay(1000).fadeOut();
			}
        }
    });
	return false;
}

function user_registerFrm(){
    jQuery('#clr_loader').show();
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: clr_ajax_object.ajax_url,
        data: { 
            'action'       : 'clr_ajaxregister',
            'reg_username'    : jQuery('form input[name="reg_username"]').val(),
             'reg_fname'    : jQuery('form input[name="reg_fname"]').val(),
            'reg_lname'    : jQuery('form input[name="reg_lname"]').val(),
            'reg_email'    : jQuery('form input[name="reg_email"]').val(),            
            'reg_confirm_email'    : jQuery('form input[name="reg_confirm_email"]').val(), 
            'reg_country'  : jQuery('form input[name="reg_country"]').val(),
            'reg_phone' : jQuery('form input[name="reg_phone"]').val(),
            'reg_password' : jQuery('form input[name="reg_password"]').val(),
            'reg_confirm_pass'      : jQuery('form input[name="reg_confirm_pass"]').val()            
        },
        success: function(data){
            jQuery('#clr_loader').hide();
            if (data.loggedin == true){
                jQuery('form#clr_register_form .clr_response_msg').show();
                jQuery('form#clr_register_form .clr_response_msg .alert').addClass('alert-success');
                jQuery('form#clr_register_form .clr_response_msg .alert').text(data.message);
                jQuery('form#clr_register_form .clr_response_msg').delay(5000).fadeOut();                
            }else{
                jQuery('form#clr_register_form .clr_response_msg').show();
                jQuery('form#clr_register_form .clr_response_msg .alert').addClass('alert-error');
                jQuery('form#clr_register_form .clr_response_msg .alert').text(data.message);
                jQuery('form#clr_register_form .clr_response_msg').delay(5000).fadeOut();
            }
        }
    });
    return false;
}

