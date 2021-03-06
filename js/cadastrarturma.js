$('#formturma').validate({
    errorElement: 'div',
    errorClass: 'invalid-feedback',
    errorPlacement: function(error, element) {
        if ($(element).attr("name") == "radioAlunoProfessor") {
            error.insertAfter("#inputCodProfessorWrap");
        } else {
            error.insertAfter(element);
        }
    },

    highlight: (element, errorClass) => {
        $(element).removeClass('is-valid')
        $(element).addClass('is-invalid')
    },
    unhighlight: (element, errorClass) => {
        if ($(element).attr("name") == "radioAlunoProfessor") {
            $('#radioProfessor').removeClass('is-invalid')
            $('#radioAluno').removeClass('is-invalid')
        }
        else {
            $(element).addClass('is-valid')
            $(element).removeClass('is-invalid')
        }
    },
    onfocusout: (element) => {
        $(element).valid()
        $(element).addClass('js-validated')
    },
    onkeyup: (element) => {
        if ($(element).hasClass('js-validated')) {
            $(element).valid()
            $(element).addClass('js-validated')
        }
    },

    rules: {
        inputcurso: 'required',
        inputdisciplina: 'required',
        inputdia: 'required',
        inputturno: 'required'
    },
    messages: {
        inputcurso: 'Este campo é obrigatório.',
        inputdisciplina: 'Este campo é obrigatório.',
        inputdia: 'Este campo é obrigatório.',
        inputturno: 'Este campo é obrigatório.'
    }
})

function cadMessage(title, message) {
    $('#modal-login-titulo').text(title)
    $('#modal-login-corpo').text(message)
    $('#modal-login').modal()
}

// Submit
$('#formturma').submit((e) => {
    e.preventDefault()
    if ($(e.currentTarget).valid()) {
        $.post('../controller/catastrarturma.php', {
            curso: $('#inputcurso').val(),
            disciplina: $('#inputdisciplina').val(),
            dia: $('#inputdia').val(),
            turno: $('#inputturno').val(),
            descricao: $('#inputdescricao').val()
        })
        .done((result) => {
            switch (result.status) {
                case 201:
                    cadMessage('Sucesso!', 'Cadastro realizado com sucesso.')
                    // TODO: Sucesso
                    break;
                case 500:
                case 400:
                    cadMessage('Como?', 'Ocorreu um erro inesperado. Se o problema persistir, contate o suporte.')
                    break;
                case 403:
                    cadMessage('Erro', 'Alguma dos dados informados já foram cadastrados. Por favor, verifique e tentenovamente.')
                    break;
            }
        })
        .fail((jqXHR, textStatus, errorThrown) => {
            console.error(errorThrown)
        })
    }
})
