$(document).ready(function () {
$(".edit-price_bdt").on("click", function () {
    var id = $(this).data("id");
    // $(this).siblings(".db_quantity").hide();
    $(".priceEdit").hide();
    $(this).siblings(".priceEdit").show();
  });

  $(".change_price_bdt").click(function (event) {
    var $ele = $(event.target),
      data_post = {
        id: $ele.data("id"),
        // noc_id: $ele.data("noc-id"),
        price_bdt: parseInt($ele.siblings("input.price_bdt").val()),
      };
      
    if (data_post.price_bdt > 0) {
      $.post("edit_price.php", data_post, function (json_data) {
      
        if (json_data.done) {
      
          $ele
            .parent(".priceEdit")
            .siblings("span.db_price")
            .html(data_post.price_bdt);
          $ele.parent(".priceEdit").hide();
        }
      });
    } else {
      // show eroor
      msg = "Uncaught Error.\n";
    }
    
  });
  
});
