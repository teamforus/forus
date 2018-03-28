
var loaded = function (callback) {
    if (!!$) {
        $(document).ready(callback);
    } else console.error('jQuery has not been loaded yet. Function after loading will not execute');
}

loaded(() => {
    $('[data-onload]').each((index, element) => {
        $(element).trigger($(element).attr('data-onload'));
    });
    $('form[data-method]').on('submit', (event) => {
        event.preventDefault();
        var method = $form.attr('data-method');
        method(event);
        return false;
    });
});