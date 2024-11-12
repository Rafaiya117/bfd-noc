$(document).ready(()=>{
    let active_nav_set = ()=>{
        $('a.navbar').removeClass('active');
        let ll_url = window.location.href.slice(window.location.href.lastIndexOf('/')+1);
        $('a.navbar').each((i,el)=>{
            let this_href = $(el).attr('href').slice($(el).attr('href').lastIndexOf('/')+1);
            if(this_href == ll_url){
                $(el).addClass('active');
            }
            
        });



        
        

        const url = window.location.href;
       
        const pathRegex = new RegExp(`${APP_URL}(.+?)\/`); 
        
        const match = url.match(pathRegex);

        if (match) {
            const extractedPath = match[1];
            $('a.nv2').each((i,el)=>{
                let this_href = $(el).attr('href').slice($(el).attr('href').lastIndexOf('/')+1);
                if(this_href == extractedPath){
                    $(el).addClass('active');
                    
                }
            });
            
        } 
        
    };  

    active_nav_set();

});