loaded(() => {

});

var convertToIdentity = (event) => {
    var account = $(event.currentTarget).find('[name="account"]').val();
    IdentityManager.convertToIdentity(account);
}

var activatePage = function (identifier) {
    var $container = $('.page-container'),
        $holder = $('.page-holder'),
        $newPage = $('.page[data-target="' + identifier + '"]');
    if (!$holder.find($newPage).length) {
        $container.append($holder.html());
        $holder.html('');
        if (!!$newPage) {
            $newPage.remove().appendTo($holder);
        } else {
            console.error('Page "' + identifier + '" not found...');
        }
    }
}

$(document).on('click', '.nav-link', (event) => {
    var identitifier = $(event.currentTarget).attr('data-link');
    activatePage(identitifier);
});