$(document).ready(()=>{
    

    // $('form input').each((i, el)=>{
    //     $(el).attr('no-validate', 'no-validate');
    // });


    // Form
    $('form').submit((e)=>{
        
        

        // check required first
        let required = true;
        $('form input').each((i, el)=>{
            
            if($(el).attr('required') == 'required' && $(el).val().trim() == ''){
                console.log('required check1 !! ', el);
                $(el).addClass('required');
                required = false;
            }else{
                $(el).removeClass('required');
                console.log('not required  !! ', el, $(el).attr('required'), $(el).attr('required') == 'required', $(el).val().trim() == '');
            }
        });


        if(!required){
            e.preventDefault();
            return false;
        }
        
    });
});