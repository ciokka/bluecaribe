jQuery(document).ready(function(){
    var windowwidth = document.body.clientWidth; //jQuery(window).width();
    console.log(windowwidth);
    
    if(windowwidth >= 1600){
        var subtractwidth = (windowwidth-jQuery('.wpr-sub-mega-menu').outerWidth())/2;


        jQuery('.wpr-sub-mega-menu').css({'margin-left':subtractwidth})
    }

    
    

    jQuery(window).on('resize',function(){
        var windowwidth = document.body.clientWidth; //jQuery(window).width();
        if(windowwidth >= 1600){
            var subtractwidth = (windowwidth-jQuery('.wpr-sub-mega-menu').outerWidth())/2;


        jQuery('.wpr-sub-mega-menu').css({'margin-left':subtractwidth})
        }
    
        
    })
});