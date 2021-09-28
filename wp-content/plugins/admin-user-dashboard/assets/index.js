
jQuery(document).ready(function () {
    $("#userdetailsForm").submit((e) => {
        e.preventDefault();
        var form = $("#userdetailsForm");
        var formData = new FormData(form[0]);
        formData.append('action', 'update_user_details');

        $.ajax({
            url: global_obj.ajaxUrl,
            type: 'POST',
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                $('#udashmessage').text(res.message);
                setTimeout(()=>{
                    $('#udashmessage').text('');
                    window.location.href = window.location.href;
                },3000);
            }
        })
    });
})
const DisplayTabs = {
    pagesController:(e,page)=>{
        $('.nav-items').removeClass('active');
        $(e).addClass('active');
        $('.content-dash-body').addClass('d-none');
        $('#'+page).removeClass('d-none');
    }
}

const Clients = {
    addNewClient:(form)=>{
        var form = $('.'+form);
        var formData = new FormData(form[0]);
        formData.append('action','submitAddNewClientForm');

        $.ajax({
            url:global_obj.ajaxUrl,
            type:'POST',
            data:formData,
            dataType:'JSON',
            contentType:false,
            cache:false,
            processData:false,
            success:function(res){
                if(res.status == 'true'){
                    $('#message').text(res.message);
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    },2000)
                }else{
                    $('#message').text(res.message);
                    setTimeout(function () {
                        $('#message').text('');
                    },2000)
                }
            }
        })

    },
    viewClientDetials:(id)=>{
        $('#dashboard_loader').show();
        $.ajax({
            url:global_obj.ajaxUrl,
            type:'POST',
            data:{user_id:id,action:'viewClientDetials'},
            dataType:'HTML',
            success:function(res){

                $('.view-client-details-box').html(res);

                $('.client-listing-box').addClass('d-none');
                $('.client-register-page').addClass('d-none');

                $('.view-client-details-box').removeClass('d-none');

                $('.back-to-listing').removeClass('d-none');
                $('.add-new-client').addClass('d-none');
                $('#dashboard_loader').hide();
            }
        })
    },
    deleteClient:(id)=>{
        if(confirm("Are you sure to delete this user?")){
        $.ajax({
            url:global_obj.ajaxUrl,
            type:'POST',
            data:{user_id:id,action:'deleteClient'},
            dataType:'JSON',
            success:function(res){
                if(res.status == 'true'){
                    $('#dashboardMessage').text(res.message);
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    },2000)
                }else{
                    $('#dashboardMessage').text(res.message);
                    setTimeout(function () {
                        $('#dashboardMessage').text('');
                    },2000)
                }
            }
        })
    }
    }
}

$(document).on('click','.add-new-client',function(){
    $('.back-to-listing').removeClass('d-none');
    $('.add-new-client').addClass('d-none');
    $('.view-client-details-box').addClass('d-none');

    $('.client-listing-box').addClass('d-none');
    $('.client-register-page').removeClass('d-none');
});
$(document).on('click','.back-to-listing',function(){
    $('.back-to-listing').addClass('d-none');
    $('.add-new-client').removeClass('d-none');
    $('.view-client-details-box').addClass('d-none');

    $('.client-register-page').addClass('d-none');
    $('.client-listing-box').removeClass('d-none');
});