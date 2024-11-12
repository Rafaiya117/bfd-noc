$(document).ready(function(){
    
    
    var scientific_names = _.pluck(species_all, 'scientific_name');

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

        $('#species_english_name').val(obj.english_name);
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
        
       

        // $('#cites_scintific_name').html(data.scientific_name);
        // $('#cites_spices_name').html(data.english_name);
        // $('#cites_appendix').html(data.cites_appendix);
        // $('#cites_annotation').html(data.annotation);
        
       
        show_table_end(template);



        
    }
    
    function update_input_fields(data){
        $('#cites_appendix').val(data.cites_appendix);
        $('#cites_annotation').val(data.cites_annotation); 
        $('#cites_appendix_code').val(data.cites_appendix_code);
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
            
        }

        // if(data.y)
        html_table(data);
        update_input_fields(data);
        
    }

  

    $('#btn_check_cites').click(function(){
        var scientific_name =  $('#species_scientific_name').val();
        $('.loader-cities').removeClass('d-none');
        console.log($('.loader-cities'));
        if(scientific_name.length){
            $.get('../api/species_ep.php',{scientific_name:scientific_name} ,ajax_data_found);
        }else{
            console.log('No input check!');
            
        }


    });
    


        

});