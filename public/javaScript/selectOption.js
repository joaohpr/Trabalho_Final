$(document).ready(function () {

    const selectOptions = [];


    $('.cfg-card-icon').on('click', function () {

        // Adiciona o elemento clicado ao vetor
        selectOptions.push(this);


        // Percorre os elementos selecionados
        for (let i = 0; i < selectOptions.length; i++) {

            // Pega o valor do elemento selecionado
            let value = $(selectOptions[i]).attr('alt');


            // Procura o card que possui esse mesmo value
            $(`.cardSelect[value="${value}"]`).css({
                'border': '3px solid green'
            });

        }

    });

});