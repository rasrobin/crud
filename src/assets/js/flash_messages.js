function flashMessage(type, messageArray, time) {
    var container = $('.alert-container');

    if ($(container).find('.alert-' + type).length === 0) {
        $(container).append('<div class="alert alert-' + type + '"><ul></ul></div>');
    }

    var alert = $(container).find('.alert-' + type);

    messageArray.forEach(function(message) {
        $(alert).find('ul').append(
            '<li>' + message + '</li>'
        );
    });

    if (time !== 0) {
        $(alert).delay(time).fadeOut(350, function() {
            $(this).remove();
        });
    } else {
        $(alert).addClass('alert-dismissable');
        if ($(alert).find('.close').length === 0) {
            $(alert).prepend('<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
        }
    }
}

function handleFormAjaxError(flashData, container) {
    var errors = flashData.responseJSON;

    $.each(errors, function(i, error) {
        $(container).find('.form-control[name=' + i + ']').closest('.form-group').addClass('has-error');
        flashMessage('danger', [error], 0);
    });
}