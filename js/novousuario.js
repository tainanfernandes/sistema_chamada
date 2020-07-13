// Mascara do CPF
$('#inputCpf').inputmask('999.999.999-99', {clearIncomplete: true, removeMaskOnSubmit: true})

// Validador do CPF
$.validator.addMethod('cpf', (value, element) => {
    value = value.replace(/\./g, '')
    value = value.replace(/\-/g, '')
    value = value.replace(/\s/g, '').trim()

    if (/^[0-9]+$/.test(value) && value.length == 11) {
        let first_dig = 0
        let second_dig = 0
        let streak = value[0]

        // Soma os valores dos 9 promeiros digitos e multiplica de acordo com a formula
        for (var i = 0; i < 9; i++) {
            first_dig += parseInt(value[i]) * (10 - i)
            second_dig += parseInt(value[i]) * (11 - i)

            // Verifica por CPF com todos os numeros repetidos
            if (value[i] == streak) {
                streak = value[i]
            }
            else streak = null
        }

        // Se todods os numeros forem iguais
        if (streak !== null && streak == value[9] && streak == value[10]) {
            return false
        }

        // Valida o primeiro digito verificador
        first_dig = (first_dig * 10) % 11
        if (first_dig == 10) first_dig = 0
        if (first_dig != parseInt(value[9])) {
            return false
        }

        // Valida o segundo digito verificador
        second_dig += first_dig * 2
        second_dig = (second_dig * 10) % 11
        if (second_dig == 10) second_dig = 0
        if (second_dig != parseInt(value[10])) {
            return false
        }

        return true
    }
    else return false
}, 'Por favor insira um CPF válido.')

// Validador senha forte
$.validator.addMethod('senhaForte', (value, element) => {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!-/:-@\[-`{-~])(?=.{8,})/g.test(value)
}, 'Insira uma senha forte.')

// Validador
$('#formCadastrar').validate({
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
        if ($(element).attr("name") == "radioAlunoProfessor") {
            $('#radioProfessor').addClass('is-invalid')
            $('#radioAluno').addClass('is-invalid')
        }
        else {
            $(element).removeClass('is-valid')
            $(element).addClass('is-invalid')
        }
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
        inputNome: 'required',
        inputSobrenome: 'required',
        inputEmail: {
            required: true,
            email: true
        },
        inputCpf: {
            required: true,
            cpf: true
        },
        inputPassword: {
            required: true,
            senhaForte: true
        },
        inputPasswordRepeat: {
            required: true,
            equalTo: '#inputPassword'
        },
        radioAlunoProfessor: 'required'
    },
    messages: {
        inputNome: 'Este campo é obrigatório.',
        inputSobrenome:  'Este campo é obrigatório.',
        inputEmail: {
            required: 'Este campo é obrigatório.',
            email: 'Por favor insira um endereço de e-mail válido.'
        },
        inputCpf: {
            required: 'Este campo é obrigatório.'
        },
        inputPassword: {
            required: 'Este campo é obrigatório.'
        },
        inputPasswordRepeat: {
            required: 'Este campo é obrigatório.',
            equalTo: 'As duas senhas devem corresponder.'
        },
        radioAlunoProfessor: 'Este campo é obrigatório.',
        inputRa: 'Este campo é obrigatório.',
        inputCodProfessor: 'Este campo é obrigatório.'
    }
})

// Trocar pra 'Sou Professor'
$('#radioProfessor').click(_ => {
    $('#inputRaWrap').addClass('d-none')
    $('#inputCodProfessorWrap').removeClass('d-none')

    $('#inputRa').rules('remove', 'required')
    $('#inputCodProfessor').rules('add', 'required')
})

// Trocar pra 'Sou Aluno'
$('#radioAluno').click(_ => {
    $('#inputRaWrap').removeClass('d-none')
    $('#inputCodProfessorWrap').addClass('d-none')

    $('#inputRa').rules('add', 'required')
    $('#inputCodProfessor').rules('remove', 'required')
})
