$('#example').DataTable();

function deleteEstablishment(button) {
    $('#signatureHideDelete').val(button.data('id'))
    $('#name').html(button.data('name'))
    $('#formDeleteSignature').attr('action','/materias/'+ button.data('id'))
    console.log($('#formDeleteSignature').attr('action'))
}
