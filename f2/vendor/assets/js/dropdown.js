
  function set_country_codes() {

var filePath = 'country/all_country.json';

$.getJSON(filePath, function( data ) {
  $.each( data, function( key, val ) {
    $('#country_of_origin').html('<option >'+ val['Name'] +'</option>');
  });
});

}

set_country_codes();


