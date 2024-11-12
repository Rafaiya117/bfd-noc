$(document).ready(function() {
    $('.accept-btn').on('click', function(e) {
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
        console.log("-----------------------------???");
        let form = $('#denyConfirmationModal').data('form');
        let hiddenField = document.createElement("input");
        hiddenField.type = "hidden";
        hiddenField.name = "deny";
        hiddenField.value = "";

        console.log("-----------------------------");
        // form.append(hiddenField);
        // form.submit();
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
});