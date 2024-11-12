$(document).ready(function () {
  $(".edit-quantity").on("click", function () {
    var id = $(this).data("id");
    // $(this).siblings(".db_quantity").hide();
    $(".quantityEdit").hide();
    $(this).siblings(".quantityEdit").show();
  });

  $(".change_quantity").click(function (event) {
    var $ele = $(event.target),
      data_post = {
        id: $ele.data("id"),
        // noc_id: $ele.data("noc_id"),
        quantity: $ele.siblings("input.quantity").val(),
      };

    if (!_.isEmpty(data_post.quantity)) {
      $.post("edit.php", data_post, function (json_data) {
        if (json_data.done) {
          $ele
            .parent(".quantityEdit")
            .siblings("span.db_quantity")
            .html(data_post.quantity);
          $ele.parent(".quantityEdit").hide();
        }
      });
    } else {
      // show eroor
      msg = "Uncaught Error.\n";
    }
    console.log("posted?? ", data_post, !_.isEmpty(data_post.quantity));
    //window.location.reload();
  });


  // price edit


});
