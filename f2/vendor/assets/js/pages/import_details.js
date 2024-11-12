
    $('input[type="radio"]').click(function() {
        var demovalue = $(this).val();
        $("div.myDiv").hide();
        $("#show" + demovalue).show();
    });
    // $(".hide").click(function(){
    //     $(".document").hide();
    // });
    // $(".show").click(function(){
    //     $(".document").css('display', 'flex');
    // });
    $(':radio[data-rel]').change(function() {
        var rel = $("." + $(this).data('rel'));
        if ($(this).val() == 'yes') {
            rel.slideDown();
        } else {
            rel.slideUp();
            rel.find(":text,select").val("");
            rel.find(":radio,:checkbox").prop("checked", false);
        }
    });
        

