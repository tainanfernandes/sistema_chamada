$('#radioProfessor').click(_ => {
    let ra = $('#inputRaWrap'), prof = $('#inputCodProfessorWrap')

    ra.addClass('d-none')
    ra.children('input').removeAttr('required')

    prof.removeClass('d-none')
    prof.children('input').attr('required', true)
})

$('#radioAluno').click(_ => {
    let ra = $('#inputRaWrap'), prof = $('#inputCodProfessorWrap')

    ra.removeClass('d-none')
    ra.children('input').attr('required', true)

    prof.addClass('d-none')
    prof.children('input').removeAttr('required')
})
