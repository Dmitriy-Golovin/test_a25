$('.error_field').each(function() {
    $(this).on('focus', function() {
        $(this).removeClass('error_field');
        $(this).next().remove();
    })
})