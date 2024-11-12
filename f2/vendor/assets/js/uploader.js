
$('.alert').click(function (evt) {
  // someFunc(); 
evt.preventDefault();
var updatedId = $(this).attr('href');
  swal({
    title: "Update" , 
    text: "Are you sure you want to change the status?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((confirm) => {
    if (confirm) {
     //var updatedId = $(this).attr('href');
    $.ajax({
     url: "import_details.php",
     type: "POST",
    //  data: {
    //    id:updatedId
    //  },
     success: function(){
          // var str = '';
         document.location.href = updatedId;
     }
 });
     
    } else {
      swal("The status has not changed.");
    }
  });
})
