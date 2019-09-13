(function($){


jQuery(document).ready(function($) {
 // mansory layout integration
 $(".ect-masonry-template-cont").each(function(){
  var tempWrapper=$(this);
      var self =tempWrapper.find(".ect-masonary-cont");
      self.find('.ect-grid-event').first().addClass('grid-sizer');
        self.imagesLoaded(function () {
            self.masonry({
                gutterWidth: 15,
                isAnimated: true,
                itemSelector:'.ect-grid-event',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        });
        tempWrapper.find(".ect-categories li").click(function(e) {
            e.preventDefault();
            var filter = $(this).attr("data-filter");
            self.masonryFilter({
                filter: function () {
                    if (!filter) return true;
                    var content= $(this).attr("data-filter");
                      return content.includes(filter);
                }
            });
        });

      
        // category filters
        tempWrapper.find(".ect-categories li").on("click",function(){
        $(this).addClass("ect-active").siblings().removeClass('ect-active');
        var catEvents= $(this).attr('data-posts');
        var catPages=parseInt($(this).attr('data-pages'));
        var thisEle=$(this);
        var activeCat=thisEle.attr('data-filter');
        var prefetch=$(this).attr('data-prefetch');
        if(prefetch=='false'){
              $('.ect-masonay-load-more').find('.ect-load-more-btn').hide();
                ectLoadMoreContent(thisEle,tempWrapper,'catcontent');
            }else{
              if(catPages>0){
                $('.ect-masonay-load-more').find('.ect-load-more-btn').show();
              }
            }
  
    });

    tempWrapper.find('.ect-masonay-load-more').find('.ect-load-more-btn').on("click",function(){
      var thisEle=$(this);
      ectLoadMoreContent(thisEle,tempWrapper,'loadmore');
      return false;
    });
  
  });
});

  function ectLoadMoreContent(thisEle,tempWrapper,type){
   
   var settingContainer= thisEle.parents('.ect-masonry-template-cont').find('#ect-lm-settings');
  
   // var settingContainer=thisEle.parents('.ect-masonry-template-cont').find('#ect-lm-settings');
    var ajaxUrl= settingContainer.data('ajax-url');
    var settings=settingContainer.data('settings');
    var excludeEventsJson=settingContainer.attr('data-exclude-events');

    var loadMore=settingContainer.data('load-more');
    var loading=settingContainer.data('loading');
    var noEvent=settingContainer.data('loaded');
    var json_query=settingContainer.siblings('#ect-query-arg').html();
    var query=JSON.parse(json_query);

    if(type=="loadmore"){
      thisEle.find('.ect-preloader').show();
      thisEle.find('span').text(loading);
      var activeCat=tempWrapper.find(".ect-categories li.ect-active");
      var catSlug=activeCat.attr('data-filter');
      var catEvents=activeCat.attr('data-posts');
      var catPages=activeCat.attr('data-pages');
      var paged=activeCat.attr('data-paged');
    }else{
      var activeCat=thisEle;
      var catSlug=activeCat.attr('data-filter');
      var catEvents=activeCat.attr('data-posts');
      var catPages=activeCat.attr('data-pages');
      settingContainer.find('#ect-cat-load-more').show();
      var paged=thisEle.attr('data-paged');
    }
      var data = {
        'action': 'ect_catfilters_load_more',
        'query':query,
        'paged':paged,
        'cat':catSlug,
        'exclude_events':excludeEventsJson,
        'per-page':catEvents,
        'settings':settings,
      };
   jQuery.post(ajaxUrl, data, function(response) {
        var rs=JSON.parse(response);
          if(rs.events=="yes"){
    setTimeout(function() {
            var content=rs.content;
        $.each(content, function (key, val) {
              var html=$(val);
              tempWrapper.find('.ect-masonary-cont').append(html).masonry( 'appended', html, true );
              // $('.ect-masonary-cont').masonry( 'reload' );
        });
            paged=parseInt(paged)+1;
            if(rs.exclude_events){
              var oldlist=JSON.parse(excludeEventsJson);
              newExcludeList = oldlist.concat(JSON.parse(rs.exclude_events));
              settingContainer.attr('data-exclude-events','['+newExcludeList+']');
            }
           

            if(type=="loadmore"){
              activeCat.attr('data-paged',paged);
             thisEle.find('span').text(loadMore);
             thisEle.find('.ect-preloader').hide();
            }else{
              thisEle.attr('data-paged',paged);
             thisEle.attr('data-prefetch','true');
             settingContainer.find('#ect-cat-load-more').hide();
             if(catPages>0){
              tempWrapper.find('.ect-masonay-load-more').find('.ect-load-more-btn').show();
             }
            }
    },1000);
          } else{
          thisEle.find('.ect-preloader').hide();
          thisEle.find('span').text(noEvent);  
setTimeout(function() {
        if(type=="loadmore"){
          thisEle.hide().find('span').text(loadMore);
          settingContainer.find('#ect-cat-load-more').hide();
      //   settingContainer.next().append(noEvent);
            }else{
              var content=rs.content;
              thisEle.attr('data-prefetch','true');
              settingContainer.find('#ect-cat-load-more').hide();
              tempWrapper.find('.ect-masonay-load-more').find('.ect-load-more-btn').hide();
            }
 },1500);
          }  
      }); 
      
      return false;
  }


    })(jQuery);