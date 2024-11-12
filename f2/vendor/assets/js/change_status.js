
$(document).on("click","#status_change",function(e){
    var status = $(this).val();
    var id = $(this).data('id');
    if(status == 'draft'){
        status = 'waiting';
    }else{
        status = 'draft';
    }
    $.ajax({
        url : "details.php",
        type : "POST",
        data : {status:status,id:id},
        success : function(data){

        }
    });
});


