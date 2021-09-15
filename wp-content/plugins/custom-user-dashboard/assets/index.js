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