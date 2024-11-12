$(document).ready(function() {
    $('.accept-btn').on('click', function(e) {
        e.preventDefault();
        $('#confirmationModal').data('form', $(this).closest('form')).modal('show');
    });

    $('.done-btn').on('click', function(e) {
        e.preventDefault();
        $('#confirmationModal').data('form', $(this).closest('form')).modal('show');
    });
    
    $('#confirmAccept').on('click', function() {
        let form = $('#confirmationModal').data('form');
        let hiddenField = document.createElement("input");
        hiddenField.type = "hidden";
        hiddenField.name = "accept";
        form.append(hiddenField);
        form.submit();
    });

    $('.deny-btn').on('click', function(e) {
        e.preventDefault();
        $('#denyConfirmationModal').data('form', $(this).closest('form')).modal('show');
    });

    $('.confirmDeny').on('click', function() {
        
        
        let form = $('#denyConfirmationModal').data('form');
        let denyReason = $('#denyReason').val().trim();
        if(denyReason === ''){
            $('#denyReason').css('border-color', 'red');
            return;
        }else{
            $('#denyReason').css('border-color', '#cacaca');
        }

        let hiddenFieldDeny = document.createElement("input");
        hiddenFieldDeny.type = "hidden";
        hiddenFieldDeny.name = "deny";
        hiddenFieldDeny.value = $(this).data('action'); 

        let hiddenFieldReason = document.createElement("input");
        hiddenFieldReason.type = "hidden";
        hiddenFieldReason.name = "denyReason";
        hiddenFieldReason.value = $('#denyReason').val(); 

        form.append(hiddenFieldDeny);
        form.append(hiddenFieldReason);
        form.submit();
    });
    $('.send-back-btn').on('click', function(e) {
        e.preventDefault();
    $('#sendBackModal').modal('show');
});

$('#sendBackRoleSelect').on('change', function() {
    let selectedRole = $(this).val();
    let selectedStatus = $(this).find('option:selected').data('status');

    // Update the hidden input fields with selected role and status
    $('#status').val(selectedStatus);
    console.log('Selected Role:', selectedRole);
    console.log('Selected Status:', selectedStatus);
});

$('#confirmBack').on('click', function() {
    let form = $('#sendBackForm'); // Ensure correct form ID here
    let hiddenField = document.createElement("input");
    hiddenField.type = "hidden";
    hiddenField.name = "back";
    form.append(hiddenField);
    form.submit();
});

$('.chalan-inappropriate-btn').on('click', function(e) {
    e.preventDefault();
    $('#submitChalanAgainModal').data('form', $(this).closest('form')).modal('show');
});

$('#confirmSubmitChalanAgain').on('click', function() {
    let form = $('#submitChalanAgainModal').data('form');
    let hiddenField = document.createElement("input");
    hiddenField.type = "hidden";
    hiddenField.name = "submit_chalan_again";
    form.append(hiddenField);
    form.submit();
});

$('.documents-not-right-btn').on('click', function(e) {
    e.preventDefault();
    $('#documentsNotRightModal').data('form', $(this).closest('form')).modal('show');
});

$('#confirmDocumentsNotRight').on('click', function() {
    let form = $('#documentsNotRightModal').data('form');
    let hiddenField = document.createElement("input");
    hiddenField.type = "hidden";
    hiddenField.name = "documents_not_right";
    form.append(hiddenField);
    form.submit();
});

$('.noc-inappropriate-btn').on('click', function(e) {
    e.preventDefault();
    $('#incompleteModal').data('form', $(this).closest('form')).modal('show');
});

$('#confirmIncomplete').on('click', function() {
    let form = $('#incompleteModal').data('form');
    let hiddenField = document.createElement("input");
    hiddenField.type = "hidden";
    hiddenField.name = "incomplete";
    form.append(hiddenField);
    form.submit();
});

});

// function error_msg(){
//     swal("Error", "Vendor needs to do this step", "error");
// }