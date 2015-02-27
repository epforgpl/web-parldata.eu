/***************************************************
      Docs Voting
***************************************************/

jQuery().ready(function(){
    jQuery('a.pakb-like-btn').click(function(){
        response_div = jQuery(this).parent().parent();
        jQuery.ajax({
            url         : PAKB.base_url,
            data        : {'pakb_vote_like':jQuery(this).attr('post_id')},
            beforeSend  : function(){
                
            },
            success     : function(data){
                response_div.hide().html(data).fadeIn(900);
            },
            complete    : function(){
                
            }
        });
    })
    
    jQuery('a.pakb-dislike-btn').click(function(){
        response_div = jQuery(this).parent().parent();
        jQuery.ajax({
            url         : PAKB.base_url,
            data        : {'pakb_vote_dislike':jQuery(this).attr('post_id')},
            beforeSend  : function(){
                
            },
            success     : function(data){
                response_div.hide().html(data).fadeIn(900);
            },
            complete    : function(){
                
            }
        });
    })

})

jQuery(document).ready(function ($) {

  $('p.likes').tooltip({
    'placement' : 'top'   
    });

  $('p.dislikes').tooltip({
    'placement' : 'top'   
    });

}); 

