$(function () {
    $('.btn-curtir').each(function (index) {
        const button = $(this);
        const key = 'filme-curtido-' + index;

        function update(curtiu) {
            button
                .toggleClass('curtiu', curtiu)
                .text(curtiu ? '♥' : '♡');

            localStorage.setItem(key, curtiu);
        }

        update(localStorage.getItem(key) === 'true');

        button.on('click', function (event) {
            event.stopPropagation();
            update(!button.hasClass('curtiu'));
        });
    });
});
