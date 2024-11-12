$(document).ready(function(){  
     var id = $(this).data('id');
    $('#id').on('click',function(){  
         var insert_values = ''; 
         
         $('.condition').each(function(){  
              if($(this).is(":checked"))  
              {  
                   insert_values+= '<li>'+$(this).val()+'</li>';  
              }  
         });  
     //     insert_values = insert_values.toString();  
         $.ajax({  
              url:"../../api/export_con.php",  
              method:"POST",  
              data:{
               insert_values:insert_values,
               name: $('#cif_name').val(),
               email_fwrd: $('#email_fwrd').val(),
               post_id: $('#post_id').val(),
               id:id
          },  
              success:function(data){  
                  // $('#post_id').html(data);  
                  // alert("?");
                 // window.location.href ="full_details.php?id="+64;
                  console.log(data.id)
              }  
         });  
    });  
});  