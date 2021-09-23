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

$(document).on('click','.add-new-client',function(){
    $('.back-to-listing').removeClass('d-none');
    $('.add-new-client').addClass('d-none');

    $('.client-listing-box').addClass('d-none');
    $('.client-register-page').removeClass('d-none');
});
$(document).on('click','.back-to-listing',function(){
    $('.back-to-listing').addClass('d-none');
    $('.add-new-client').removeClass('d-none');

    $('.client-register-page').addClass('d-none');
    $('.client-listing-box').removeClass('d-none');
});