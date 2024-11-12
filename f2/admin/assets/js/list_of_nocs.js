$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});

	$(".edit-quantity").on("click", function () {
	  var id = $(this).data("id");
	  // $(this).siblings(".db_quantity").hide();
	  $(".quantityEdit").hide();
	  $(this).siblings(".quantityEdit").show();
	});
  
	$(".change_quantity").click( (event)=> {
		var $ele = $(event.target),
		  data_post = {
			id: parseInt($ele.data("id")),
			noc_id: $ele.data("noc_id"),
			quantity: parseInt($ele.siblings("input.quantity").val()? $ele.siblings("input.quantity").val(): 0),
		  };
	  
		if (data_post.quantity > 0) {
		  $.post("edit.php", data_post,  (json_data) => {
			if (json_data.done) {
			  $ele
				.parent(".quantityEdit")
				.siblings("span.db_quantity")
				.html(data_post.quantity);
			  $ele.parent(".quantityEdit").hide();
			  console.log("posted ", data_post);
			  window.location.reload();
			}
			console.log("posted?? ", data_post, data_post.quantity !== "");
			
		  });
		} else {
		  // show error
		  msg = "Uncaught Error.\n";
		}
		
		console.log("button hit.. ");
		
	});
});