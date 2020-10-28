$('#example').DataTable( {
    "searching": true,   // Search Box will Be Disabled
    "ordering": true,    // Ordering (Sorting on Each Column)will Be Disabled
    "info": true,         // Will show "1 to n of n entries" Text at bottom
    "lengthChange": false, // Will Disabled Record number per page
    "iDisplayLength": 25, // default display length
});

function deleteSignature(button) {
    $('#signatureHideDelete').val(button.data('id'))
    $('#name').html(button.data('name'))
    $('#formDeleteSignature').attr('action','/materias/'+ button.data('id'))
    console.log($('#formDeleteSignature').attr('action'))
}
