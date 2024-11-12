$(document).ready(function(){
    
    
    var scientific_names = _.pluck(species_all, 'scientific_name');
    let last_selected_species = {}, local_database_species = {};
    autocomplete($('#species_scientific_name')[0], scientific_names);
    
    $('#species_scientific_name').bind('change', function(e){
        var scientific_name = $(e.target).val();
        var obj = _.find(species_all, {scientific_name: scientific_name});

        if(_.isEmpty(obj)){
            obj = {
                english_name : '',
                id:''
            };
            
        }

        if($('#species_english_name').val().trim().length == 0){
            $('#species_english_name').val(obj.english_name);
        }

        $('#species_id').val(obj.id);
        // console.log(scientific_name, obj);

    });

    function tb_rows(key, value){
        return '<tr><th>'+key+'</th>'+
                '<td>'+value+'</td></tr>';
    }

    function btn_search(){
        var scientific_name = $('#species_scientific_name').val();
        // https://www.iucnredlist.org/search?searchType=species&query=
        return '<a class="btn btn-danger" style="color:white;" target="_blank"  href="https://www.iucnredlist.org/search?searchType=species&query='+   scientific_name + '"> IUCN Redlist </a>     '+
        '<a class="btn btn-success " style="color:white;" target="_blank"  href="http://www.google.com/search?q='+   scientific_name + '"> Google </a> ' + 
          '<a class="btn btn-primary" style="color:white;" target="_blank"  href="https://en.wikipedia.org/wiki/Special:Search?go=Go&ns0=1&search=' + scientific_name +'" > Wikipedia </a>';
    }

    function show_table_end(template){
        $('#cites_data_table').removeClass('d-none').html(template); 
        $('.loader-cities').addClass('d-none'); 
    }
    function wrong_scientific_name(data, reason){
        var template = '';
        template += tb_rows('Scientific Name', reason);
        template += tb_rows('', 'This species can be unlisted for 2 reasons <ol> <li>1. Wrong scientific name</li> <li>2. Not Listed in Cities Appendix.</li> </ol>');
        template += tb_rows('Search ', btn_search());
        template += tb_rows('What to Do ', 
            '<ol>'
            + '<li>- If you do not find the scientific Name, in IUCN Redlist, Google and wikipedia, it means a wrong scientific name is provided. </li>'
            +'<li>- Please check on IUCN Conservation level on Redlist, before you give this species NOC. </li>' 
            +'</ol>'
            );
        show_table_end(template);
    }

    function html_table(data){
        var template = '';
        
        if(_.isUndefined(data.scientific_name)){
            wrong_scientific_name(data, 'Scientific Name "'+ $('#species_scientific_name').val() +'", has not found in CITES API. ');
            
            return;
         }

         

        template += tb_rows('Scientific Name', '<i>' + data.scientific_name+ '</i>');

        if(!_.isUndefined(data.alt_scientific_name) && !_.isEmpty(data.alt_scientific_name)){          
            template += tb_rows('Alternate Scientific Name ', '<i>' + data.alt_scientific_name+ '</i>');
        }



        template += tb_rows('General Name', data.english_name);
        template += tb_rows('Common Names (en)', data.common_names);
        template += tb_rows('CITES Appendix Status', data.cites_appendix);
        
        if(!_.isUndefined(data.cites_appendix_code)){
            template += tb_rows(data.cites_appendix + ' ' , CITES_APPENDIX_MEANING[data.cites_appendix_code]);
        }

        if(!_.isUndefined(data.cites_annotation)){
            template += tb_rows('CITES Annotation', data.cites_annotation);
        }
        
        
        
        show_table_end(template);
    }
    function update_input_fields(data){
        if(data.cites_annotation == null){
            data.cites_annotation = 'Not Found';
            data.cites_appendix_code = '';
        }
        $('#cites_appendix').val(data.cites_appendix);
        $('#cites_annotation').val(data.cites_annotation); 
        $('#cites_appendix_code').val(data.cites_appendix_code);
    
        if($('#species_english_name').val().trim().length == 0){
            $('#species_english_name').val(data.english_name);
        }
    }

    function ajax_data_found(data){
        
        if(_.isEmpty(data)){
            data = {
                scientific_names: 'Not found',
                english_name: 'Not found',
                cites_appendix: 'Not Listed',
                cites_appendix_code: 'NOT_FOUND',
                annotation: 'Please check the "scientific name" on wiki / google, for clarification.',
            };
        }else{
            data.cites_appendix_code =  data.cites_appendix;
            if(data.cites_appendix.length > 0 && data.cites_appendix.length < 4){
                data.cites_appendix = 'CITES Appendix ' +  data.cites_appendix;
            }
            if(!_.isUndefined(data.cites_annotation)){

                template += tb_rows('CITES Annotation', data.cites_annotation);
            }


            if(data.alt_scientific_name_2 !== null){
                data.alt_scientific_name = data.alt_scientific_name + ', ' + data.alt_scientific_name_2;
            }
            data.english_name = data.common_names;
        }
        last_selected_species = data;
        html_table(data);
        update_input_fields(data);
        
    }

  
// Dermochelys coriacea
    $('#btn_check_cites').click(function(){
        var scientific_name =  $('#species_scientific_name').val();
        var subject = $('#sub_of_noc').val();
        $('.loader-cities').removeClass('d-none');
        console.log($('.loader-cities'));
        if(scientific_name.length){
            $.get(BASEURL + '/api/species_ep.php',{scientific_name:scientific_name} ,ajax_data_found);
        }else{
            console.log('No input check!');
            
        }


    });

    
    
    
    $('input[type="radio"]').click(function(){
    	var demovalue = $(this).val(); 
        $("div.myDiv").hide();
        $("#show"+demovalue).show();
    });

    // $('#button').prop('disabled', true);
    $('.source').on('change', function(e) {
        e.stopPropagation();
        // $('#button').prop('disabled', true);
        var source = $(e.target).val();
        console.log("change 1", source);
        if(source == 'captive'){
            $('#show_captive_section').removeClass('d-none').show();
            $('#show_wild_section').hide();
        }else if(source == 'wild'){
            $('#show_wild_section').removeClass('d-none').show();
            $('#show_captive_section').hide();
        }
    });

    
    $('.check_magic input[type="radio"]').change(
        (e)=>{
            var value = $(e.target).val().trim();
            let parent = $(e.target).parent().parent();
            var message = '';

            if(value == 'yes'){
               
                message = $(parent).find('.message .yes').html();
                
            }else {
                message = $(parent).find('.message .no').html(); 
                // $('form button[type="submit"]').prop('disabled', true);
            }

            $(parent).find('.info').html(message);

            
            // let both_yes = true;
            // $(parent).parent('.both-yes').find('input[type="radio"]').each(function(i, ele){
            //     console.log(ele, i);
            //     if($(ele).val() == 'yes' && both_yes) { 
            //         both_yes = true
            //     } else{
            //         both_yes = false;
            //     }

            //  });

            //  if(both_yes){
            //     $('form button[type="submit"]').prop('disabled', false);
            //  }else{
                
            //  }
                

        }
    );


    show_pb_message = (message)=>{
        $('#problems').removeClass('d-none').html(message);
    };
    // on click check 

        $('#save_sp').click(function(){
            // alert("what is this?");
            let required_fields = ()=>{
                let fields = ['species_scientific_name','species_english_name','quantity','price_bdt'];
                let message = '';
                fields.forEach((field)=>{
                    if($('#'+field).val().trim().length == 0){
                        message += field + ' is required. <br>';
                    }
                });

                return message;
            },
            hide_pb_message = function(){
                $('#problems').addClass('d-none').html('');
            },
            check_cities_first = function(){
                if(!_.isEmpty(last_selected_species)){
                    return '';
                }
                return 'Please Search for the CITES API first.<br>';
            },
            if_cities_noc_api_check_index = function(){
                console.log("--->> ", last_selected_species);
                if(!_.isUndefined(last_selected_species.cities_id)){
                    return '';
                }
                return 'You Can`t add a CITIES Not Listed Species in a CITIES NOC.<br>';
            },
            if_non_cities_noc_api_check_index = function(){
                console.log("--->> ", last_selected_species);
                if(_.isUndefined(last_selected_species.cities_id)){
                    return '';
                }
                return 'You Can`t add a CITIES Listed Species in a Non-CITIES NOC.<br>';
                
            },
            according_to_cities_index = function(){
                
                
                if(this_noc.sub_of_noc === "CITES"){
                    return if_cities_noc_api_check_index();
                }else if(this_noc.sub_of_noc === "NON-CITES"){
                    return if_non_cities_noc_api_check_index();
                }
                

            }, 
            check_wild_captive = function(source_wild_or_captive){

                if(!_.isUndefined(source_wild_or_captive)){
                    return '';
                }
                return 'You have to selected source of your specimen (wild / captive) <br>';
            },
            both_no_check = (source_wild_or_captive)=>{
                // wild or captive
                let radio = $('#show_'+source_wild_or_captive + '_section input[type=radio]:checked');
                
                if(radio.length < 1){
                    return 'Select Yes or No for both questions. <br>';
                }
                if($(radio[0]).val() == 'no' || $(radio[1]).val() == 'no'){
                    return 'Without proper documentation, you can not bring any spices.<br>';
                }

                return '';
            }, check_bfd_wildlife_schedule = ()=>{
                let species_id = $('#species_id').val().trim();
                if(species_id.length == 0){
                    return '';
                }
                species_id = parseInt(species_id);
                let sp_obj = _(species_all).where({id:species_id})[0];
                console.log(species_id, ' #NO.. -->>>. ?? ', sp_obj);
                if(_.isUndefined(sp_obj.schedule)){
                    return '';
                }

                return 'This species is listed in BFD Wildlife Schedule. <b> '+ 
                sp_obj.schedule 
                +'</b> species can\'t be added in NOC.<br>';


            }, check_mutation = ()=>{
                if (!$('input[name="muted"]').is(':checked')) {
                    //   alert('Please select Yes or No for "Is the species mutated?"');
                      return 'Please select Yes or No for "Is the species mutated?" <br>';
        
                    //   event.preventDefault();
                }
                return '';
            },
            IUCN_check = ()=>{
                if(!is_iucn_red_list_required){
                    return '';
                }
                // wild or captive
                let IUCN = $('#species_IUCN').val();
                if(IUCN === null){
                    return 'Please select the IUCN status of this species. <br>';
                }
                

                return '';
            };
            var hiddenRingNumbers = $('#hidden_ring_numbers');
            if (hiddenRingNumbers) {
                hiddenRingNumbers.value = ringNumbers.join(',');
            }

       

            let source_wild_or_captive = $('.source:checked').val();

            let error = '';
            error += required_fields();
            error += check_cities_first();
            if (this_noc.sub_of_noc === "CITES") {
                error += according_to_cities_index();
                error += check_wild_captive(source_wild_or_captive);
                error += both_no_check(source_wild_or_captive);
            }

            error += check_bfd_wildlife_schedule();
            error += IUCN_check();
        
            error += check_mutation();
            console.log(this_noc);
            if(!_.isEmpty(error)){
                show_pb_message('Sorry, you can not add this spices. <br>' + error);
                return;
            }
            

            

            console.log('BL :>> error >> ', error);
            
            // action??
            // Assuming you have a form with id 'myForm'
            if(error.length === 0){
                hide_pb_message();
                $('#form_to_add_species').submit();
                
                return;

            }
            
        });
        let open_IUCN = ()=>{
            let scientific_name = $('#species_scientific_name').val();
            console.log('scientific_name', scientific_name);
            if(scientific_name !== ''){
                let url = 'https://www.iucnredlist.org/search?searchType=species&query='+   scientific_name;
                window.open(url, '_blank');
                return;
            }
            alert('Please enter a scientific name first.');
            
        } ;
        window.open_IUCN = open_IUCN;
        // $('#form_to_add_species').on('submit', function(event) {
           
        // });
});
var ringNumbers = [];

    function addRingNumber() {
        var ringNumber = document.getElementById('ring_number').value;
        if (ringNumber !== '') {
            ringNumbers.push(ringNumber);
            document.getElementById('hidden_ring_numbers').value = ringNumbers.join(',');
            document.getElementById('ring-number-list').innerHTML += '<p>' +'Ring Numbers: '+ ringNumber + '</p>';
            document.getElementById('ring_number').value = ''; // Clear the input field
            document.getElementById('ring_number').placeholder = ringNumbers.join(','); // Display comma-separated values as placeholder
        }
    }

    // $('#save_sp').click(function() {
        
    // });