// function updates(y) {
//   console.log();
//  }
 
 
function someFunc() {
    swal({
          title: "Update" , 
          text: "Are you sure you want to change the status?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((confirm) => {
          if (confirm) {
           var updatedId = $(this).attr('id');
          $.ajax({
           url: "details.php",
           type: "POST",
           data: {
             id:updatedId
           },
           success: function(data){
                var str = '';
               window.location.href = "details.php?id="+ data;
               // window.location.href = "details.php?id=11"; 
           }
       });
           
          } else {
            swal("The status has not changed.");
          }
        });
}
//let str = x ;

$('#approval').click(function () {
  someFunc(); 
})
