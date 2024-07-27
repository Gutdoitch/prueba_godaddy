jQuery(function ($) {

    var length = $('.mayosisajaxsearch').attr('data-length');
    var tag = $('.mayosisajaxsearch').attr('search-by-tag');
    var category = $('.mayosisajaxsearch').attr('search-by-category');
    var notFound = $('.mayosisajaxsearch').attr('data-not-found');

    if ('true' == tag) {
        tag = true;
    }else{
        tag = false;
    }

    if ('true' == category) {
        category = true;
    }else{
        category = false;
    }

    $(".mayosisajaxsearch").on('keyup', function(e) {

        var result = $(this).parent().find('.mayosis_edd_search_result') ;

        var search_val = $(this).val(); 

        if(search_val.length < length ){
            $(result).html("");
             $(".mayosis_edd_search_result").removeClass("active");
             
              
            
        }
        else {

            $.ajax({
                url: mayosis_edd_search_wp_ajax.ajaxurl,
                type:"post",
                dataType: "json",
                data: { 
                    action: 'mayosis_edd_search_fetch_data',
                    security: mayosis_edd_search_wp_ajax.ajaxnonce,
                    mayosisajaxsearch: search_val,
                    tag: tag,
                    category: category
                },
                error:function(response){

                    $(result).html("");
                    
                },
                success:function(response){
                    var output = '';

                    if (response.status == 1 ) {
                        output += '<ul>';
                        if (response.data) {
                            $.each(response.data,function( key, post ){   
                                output += '<li><div class="msv-ajax-thumbs"><a href="'+post['link']+'">'+post['thumb'] + '</a></div><div class="msv-ajax-meta"><h3><a href="'+post['link']+'">'+post['title'] + '</a><span class="ajax-search-author">'+post['authorname'] +'</span></h3><span class="ajax-search-price">'+post['price'] + '</span></div></li>';
                            });
                        }else{
                            output += '<li>'+ notFound +'</li>';

                        }
                        output += '</ul>';
                    }
                    else{
                        output += '<ul><li>'+response.error+'</li></ul>';
                    }
                    $(".mayosis_edd_search_result").addClass("active");
                    $(".mayosis-edd-ajax-search").removeClass("loading-ajax-ico");
                    $(".mayosis-ajax-search-btn").removeClass("hidden");
                    $(result).html(output);
                }

            });

        }

    });   
});


jQuery(document).ready(function($){
 //when keyup on textbox
 $(".mayosisajaxsearch").keyup(function(){
       var keyValue = $(this).val();
   if(keyValue) { 
       $(".mayosis-edd-ajax-search").addClass("loading-ajax-ico");
       $(".mayosis-ajax-search-btn").addClass("hidden");
   } else {
       $(".mayosis-edd-ajax-search").removeClass("loading-ajax-ico");
   }
 });
 
 $(".mayosisajaxsearch").blur(function(){
	var keyValue = $(this).val();
   if(!keyValue){
        $(".mayosis-edd-ajax-search").removeClass("loading-ajax-ico");
   } 
   
 });
 
});