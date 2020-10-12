$('#formLoginAluno').submit(function (event) {
    event.preventDefault()
    $.post({
        url: "controller/validaUsuario.php",
        type: 'POST',
        data: {
            email: $('#inputEmail').val(),
            senha: $('#inputPassword').val()
        },

        success: function (data) {
            window.open("aluno/principalaluno.php", '_self');

        },
        error: function (data) {
            $("#alert").html("teste de erros");

        }
    })

    .done((result) => {
        console.log(result);
        switch (result.status) {
            case 201:
                loginMessage('Sucesso!', 'Cadastro realizado com sucesso.')
                // TODO: Sucesso
                break;
            case 400:
                loginMessage('Como?', 'Ocorreu um erro inesperado. Se o problema persistir, contate o suporte.')
                break;
            case 403:
                loginMessage('Erro', 'Alguns dos documentos informados pertence a outro usuário. Por favor, verifique os dados inseridos.')
                break;

                case 304:
                loginMessage('Erro', 'Deus vai ajudar')
                break;
        }

    });
    
});
