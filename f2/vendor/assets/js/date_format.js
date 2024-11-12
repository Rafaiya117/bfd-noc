$(document).ready(function(){
    $('input[type="date"]').change(function() {
        const input = $(this);
        const date = new Date(input.val());
    
        // Format the date to dd/mm/yy
        const formattedDate = (date.getDate() < 10 ? '0' + date.getDate() : date.getDate()) + 
                             '/' + 
                             (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1)) + 
                             '/' + 
                             date.getFullYear().toString().substr(-2);
    
        // Update the input value with the formatted date (optional)
        input.attr("type", "text");
        input.val(formattedDate);
    
        // Do something with the formatted date (e.g., display it elsewhere)
        console.log("Formatted date:", formattedDate);
      });
      console.log("Formatter loaded date:");

});