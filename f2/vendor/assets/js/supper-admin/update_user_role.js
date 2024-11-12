$(document).ready(function(){

    let designation = $('#designation').data('designation'),
        update_role = ()=>{
            let role = $('#designation option:selected').attr('data-role');
            $('#role').val(role);
        };
    $('#designation').val(designation);
    update_role();

    // console.log($('#designation option:selected').attr('designation'));

    $('#designation').change(function(){
        update_role();
    });
});