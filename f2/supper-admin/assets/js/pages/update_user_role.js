$(document).ready(function(){

    $('#designation').val('<?= $user_info['designation']?>');
    $('#role').val('<?= $user_info['role']?>');

    $('#designation').change(function(){
        var role = $('#designation option:selected').attr('data-role');
        $('#role').val(role);
    });
});