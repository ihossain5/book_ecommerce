
  function loginFormValidation(form) {
    $(form).validate({
        rules: {
            number: {
                required: true,
                digits: true,
                minlength: 11,
                maxlength: 11,
            },
            password: {
                required: true,
            },


        },
        messages: {
            number: {
                required: 'Please insert your mobile number',
            },
            password: {
                required: 'Please insert your password ',
            },
        },
        errorPlacement: function(label, element) {
            label.addClass('h3 text-danger');
            label.insertAfter(element);
        },
    });
   }

 // login function
 function singIn(form,loginUrl,errorMessageDiv){
    $(document).off('submit', form);
    $(document).on('submit', form, function(event) {
        event.preventDefault();


        $.ajax({
            type: "POST",
            url: loginUrl,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.success == true) {
                    location.reload();
                } else {
                    $(errorMessageDiv).empty();
                    $(errorMessageDiv).html(response.data)
                    // toastr['error'](response.data);
                }
            },
            error: function(error) {
                if (error.status == 422) {
                    $.each(error.responseJSON.errors, function(i, message) {
                        toastr['error'](message);
                    });

                }
            },
        });

    });
 }  