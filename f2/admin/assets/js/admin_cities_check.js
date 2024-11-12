$(document).ready(()=>{
//     let modal =  `
// `;

//     $('body').append(modal);


    let modal_load_show = (title, body)=>{
        $('#modal_action').find('.modal-header').text(title);
        $('#modal_action').find('.modal-body').html(body);
        $('#modal_action').modal('show');
    };
    let tb_rows = (label, value)=>{ return `<tr><th>${label}</th><td>${value}</td></tr>`; };
    html_table = (show_data)=>{

        let scientific_name_show = show_data.scientific_name;
// alt_scientific_name	
// alt_scientific_name_2

        if(show_data.alt_scientific_name !== null){
            scientific_name_show +=  ' <br> ' + show_data.alt_scientific_name;
        }
        // if(show_data.alt_scientific_name_2 !== null){
        //     scientific_name_show +=  ' <br> ' + show_data.alt_scientific_name_2;
        // }


        let html = `
            <table class="table table-bordered table-striped">
                <tbody>
                    ${tb_rows('English Name', show_data.english_name)}
                    ${tb_rows('Scientific Name', '<i>' + scientific_name_show+ '</i>')}
                    
                    ${tb_rows('Common Names', show_data.common_names)}
                    ${tb_rows('CITES Appendix', show_data.cites_appendix)}
                    ${tb_rows('CITES Appendix Code', show_data.cites_appendix_code)}
                    ${tb_rows('Annotation', show_data.annotation)}
                    ${tb_rows('CITES Effective At', show_data.effective_at)}
                    ${tb_rows('Kingdom', show_data.kingdom)}
                    ${tb_rows('Phylum', show_data.phylum)}
                    ${tb_rows('Class', show_data.class)}
                    ${tb_rows('Order', show_data.order)}
                    ${tb_rows('Family', show_data.family)}

                      

                </tbody>
            </table>
        `;
        modal_load_show("CITES API Response", html);
        
    };



    let ajax_data_found = (data)=>{
        console.table(data);

        if(_.isEmpty(data)){
            data = {
                scientific_names: 'Not found',
                english_name: 'Not found',
                cites_appendix: 'Not Listed',
                cites_appendix_code: 'NOT_FOUND',
                annotation: 'Please check the "scientific name" on wiki / google, for clarification.',
                effective_at: '',
                kingdom: '',
                phylum: '',
                class: '',
                order: '',
                family: '',
                common_names: '',
                cites_annotation: '',
                alt_scientific_name: '',
                alt_scientific_name_2: '',
                


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
        
    };

    $(".check_cites").click((e)=>{
        let scientific_name = $(e.target).data('scientific_name');
        $('#modal_action').modal('show');;
        $.get('../../../api/species_ep.php',{scientific_name:scientific_name} ,ajax_data_found);
        
        modal_load_show('Checking on CITES API', 'Please wait while we check the CITES for you ...');
        
        // console.log();
    });



});