

    $(document).ready(function() {
        $('.purpose_based_options').hide();
        $('#purpose').change(function() {
            $('.purpose_based_options').hide();
            let selected_purpose = $(this).val();
            if(selected_purpose){
                $('#' +selected_purpose ).show();
            }
            
        });
        // $.ajax({
        //     url: 'get_upazila.php',
        //     type: 'GET',
        //     dataType: 'json',
        //     success: function(response) {
        //         $('#district').html('<option value=""></option>');
        //         $.each(response.districts, function(index, district) {
        //             $('#district').append('<option value="' + district.name + '">' + district.name + '</option>');
        //         });
        //     }
        // });

        $('#district').change(function() {
            let district = $(this).val();
            let response = _(location_data.upazilas).filter(upazila => upazila.district_name === district);
            let up_ops = '<option value=""></option>';
            $.each(response, function(index, upazila) {
                up_ops += '<option value="' + upazila.name + '">' + upazila.name + '</option>';
            });
     
            up_ops += '<option value="Others">Others</option>';
     
            $('#upazila').html(up_ops);


    
});



$('#upazila').change(function() {
    var selectedUpazila = $(this).val();
    if (selectedUpazila === 'Others') {
        if (!$('#other-upazila-input').length) {
            $(this).after('<input type="text" id="other-upazila-input"  name="other-upazila-input"  value="', post_other_upazila_input ,'"  class="form-control" placeholder="Enter Upazila name">');
        }
    } else {
        $('#other-upazila-input').remove();
    }
});

    $('#reg_form').submit(function(e) {
        let stop = () => {
            e.preventDefault();
            return false;
        };


            if ($('#agree').prop('checked') == false) {

                alert('Please agree to the terms and conditions');
                return stop();
            }

            if (!/^(?:\d{10}|\d{11}|\d{13})$/.test($('#nid').val())) {
               alert('NID number must be 10, 11, or 13 digits');
               return stop();
            }
            if ($('#purpose').val() === '') {
                alert('Select a "Account Type" to let us know about the accounts purpose');
                return stop();
            } else if ($('#purpose').val() === 'Commercial') {
                // if ($('#company_licence_num').val().length < 3) {
                //     alert('Company licence number must be at least 3 characters');
                //     return stop();
                // }
                if ($('#company_licence_validity').val() !== '') {
                    var licenceValidityDate = new Date($('#company_licence_validity').val());
                    var today = new Date();
                    if (licenceValidityDate <= today) {
                        alert('Company licence validity date has expired');
                        return stop();
                    }
                } else {
                    alert('Company licence number is required');
                    return stop();
                }
                if ($('#company_licence_num').val().length == '') {
                    alert('Company licence validity date is required');
                    return stop();
                }
                // if ($('#applicant_designation').val().length < 3) {
                //     alert('Applicant designation must be at least 3 characters');
                //     return stop();
                // }
                if ($('#company_phone').val().length < 3) {
                    alert('Company name must be at least 3 characters');
                    return stop();
                }
                if ($('#affliation_applicant').val().length < 3) {
                    alert('Applicant affiliation must be at least 3 characters');
                    return stop();
                }

            }
            else if ($('#purpose').val() === 'Institution') {
                if ($('#institutional_name').val().length < 3) {
                    alert('Institution name must be at least 3 characters');
                    return stop();
                }
                if ($('#institutional_address').val() == '') {
                    alert('Institutional Address is required');
                    return stop();
                }
                if ($('#institutional_contact').val().length < 3) {
                    alert('Contact number must be 11 digits');
                    return stop();
                }
                if ($('#intitute_email').val().length < 3) {
                    alert('Institutional address must be at least 3 characters');
                    return stop();
                }
                if ($('#purpose_import_export').val().length < 3) {
                    alert('Purpose must be at least 3 characters');
                    return stop();
                }
                if ($('#source_species').val().length < 3) {
                    alert('Source of species must be at least 3 characters');
                    return stop();
                }
            }
             else {
                if ($('#phone').val().length < 10) {
                    alert('Phone value must be 11 digits');
                    return stop();
                }
            }
        });
    });


    var passwordInput = document.getElementById('password');
    var rePasswordInput = document.getElementById('re-password');
    var errorMessage = document.getElementById('re-password-error');

    rePasswordInput.addEventListener('input', function() {
        if (passwordInput.value !== rePasswordInput.value) {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }
    });


   $(document).ready(function(){
    $('#applicant_designation').parent().hide();
        $('#affliation_applicant').change(function() {
            if ($(this).val() === 'employee') {
            $('#applicant_designation').parent().show();
        } else {
    $('#applicant_designation').parent().hide();
    }
    });
});
