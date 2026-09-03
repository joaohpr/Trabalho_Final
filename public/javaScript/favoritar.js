$(function () {
    $('.btn-favorito').each(function (index) {
        const button = $(this);
        const key = 'filme-favorito-' + index;

        function update(isFavorite) {
            button.toggleClass('favoritado', isFavorite);
            localStorage.setItem(key, isFavorite);
        }

        update(localStorage.getItem(key) === 'true');

        button.on('click', function (event) {
            event.stopPropagation();
            update(!button.hasClass('favoritado'));
        });
    });
});
