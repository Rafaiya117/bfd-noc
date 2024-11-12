$(document).ready(function() {
    // $('#cites-fields').hide();
    $('#sub_of_noc').on('change', function() {
      var selectedValue = $(this).val();
      if (selectedValue === 'CITES') {
        $('#cites-fields').show();
        $('#cites-fields .cites-fields').attr('required', true);
      } else {
        $('#cites-fields').hide();
        $('#cites-fields .cites-fields').removeAttr('required');
      }
    });
    // console.log('create_new_noc_view.js Trumps action');
  });