function em_search_bar(){
	jQuery(".search-input").val('Search');
	searchinput = jQuery(".search-input"),
	searchvalue = searchinput.val();
	searchinput.click(function(){
		if (jQuery(this).val() === searchvalue) jQuery(this).val("");
	});
	searchinput.blur(function(){
		if (jQuery(this).val() === "") jQuery(this).val(searchvalue);
	});
}

if (typeof checkIfTouchDevice != 'function') { 
    function checkIfTouchDevice(){
        touchDevice = !!("ontouchstart" in window) ? 1 : 0; 
		if( jQuery.browser.wd_mobile ) {
			touchDevice = 1;
		}
		return touchDevice;      
    }
}

function sticky_main_menu( on_touch ){
		var _topSpacing = 0;
		if( jQuery('body').hasClass('logged-in') && jQuery('body').hasClass('admin-bar') && jQuery('#wpadminbar').length > 0 ){
			_topSpacing = jQuery('#wpadminbar').height();
		}
		if( !on_touch && jQuery(window).width() > 768 ){
			jQuery(".header-top").sticky({topSpacing:_topSpacing});
		}
}




function hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function set_header_bottom(){
    var header_bottom_height = jQuery(".header-bottom").outerHeight();
    jQuery(".header-bottom").css("bottom","-"+header_bottom_height+"px");
    jQuery(".main-slideshow").css("min-height",header_bottom_height + "px");
}

function set_cloud_zoom(){
	var clz_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').width();
	var clz_img_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').children('img').width();
	var cl_zoom = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
	var temp = (clz_width-clz_img_width)/2;
	if(cl_zoom.length > 0 ){
		cl_zoom.data('zoom',null).siblings('.mousetrap').unbind().remove();
		cl_zoom.CloudZoom({ 
			adjustX:temp	
		});
	}
}
function onSizeChange(windowWidth){
	if( windowWidth >= 768 ) {
			jQuery('a.block-control').removeClass('active').hide();
			jQuery('a.block-control').parent().siblings().show();
	}
	if( windowWidth < 768 ) {
			jQuery('a.block-control').removeClass('active').show();
			jQuery('a.block-control').parent().siblings().hide();
	}		

}


function change_cart_items_mobile(){
	var _cart_items = parseInt(jQuery( "#cart_size_value_head" ).text());
	_cart_items = isNaN(_cart_items) ? 0 : _cart_items;
	jQuery('.mobile_cart_container > .mobile_cart_number').text(_cart_items);
	
}


jQuery(document).ready(function($) {
        //var fontname1="Roboto";
        //var fontname2="Share Tech";
        //var font1="<link id='" + fontname1 + "' href='http://fonts.googleapis.com/css?family="+fontname1+"' rel='stylesheet' type='text/css' />";
        //var font2="<link id='" + fontname2 + "' href='http://fonts.googleapis.com/css?family="+fontname2+"' rel='stylesheet' type='text/css' />";
        //$("head :first-child").after(font1);
        //$("head :first-child").after(font2);
        //jQuery('head').append("<link id='" + fontname1 + "' href='http://fonts.googleapis.com/css?family="+fontname1+"' rel='stylesheet' type='text/css' />");
        //jQuery('head').append("<link id='" + fontname2 + "' href='http://fonts.googleapis.com/css?family="+fontname2+"' rel='stylesheet' type='text/css' />");
		on_touch = checkIfTouchDevice();
		
		if (jQuery.browser.msie && jQuery.browser.version <= 10) {
			jQuery("html").addClass('ie' + parseInt(jQuery.browser.version) + " ie");
		} else {
			if (jQuery("html").attr('id') == 'wd_ie' && jQuery.browser.version == 11) {
				jQuery("html").addClass("ie11 ie");
			}
		}
		/*************** Start Woo Add On *****************/
		jQuery('body').bind( 'adding_to_cart', function() {
			jQuery('.cart_dropdown').addClass('disabled working');
		} );		
        
        //set min height main slider
        var header_bottom_height = jQuery(".header-bottom").outerHeight();
		jQuery(".main-slideshow").css("min-height",header_bottom_height + "px");
        
        
        //social
        jQuery("ul.social-share > li > a > span").css("position","relative").css('display', 'inline-block').css("left","500px").css("visibility","0");
		jQuery("ul.social-share > li > a > span").each(function(index,value){
			TweenMax.to( jQuery(value),0.0, { css:{left:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
		});
		      
        
		jQuery('.add_to_cart_button').live('click',function(event){
			var _li_prod = jQuery(this).parent().parent().parent();
			_li_prod.trigger('wd_adding_to_cart');
		});
		
		jQuery('li.product').bind('wd_adding_to_cart', function() {
			jQuery(this).addClass('adding_to_cart').append('<div class="loading-mark-up"><div class="loading-image"></div></div>');
			var _loading_mark_up = jQuery(this).find('.loading-mark-up').css({'width' : jQuery(this).width()+'px','height' : jQuery(this).height()+'px'}).show();
		});
		jQuery('li.product').each(function(index,value){
			jQuery(value).bind('wd_added_to_cart', function() {
				var _loading_mark_up = jQuery(value).find('.loading-mark-up').remove();
				jQuery(value).removeClass('adding_to_cart').addClass('added_to_cart').append('<span class="loading-text">Successfully added to your shopping cart</span>');
				var _load_text = jQuery(value).find('.loading-text').css({'width' : jQuery(value).width()+'px','height' : jQuery(value).height()+'px'}).delay(1500).fadeOut();
				setTimeout(function(){
					_load_text.hide().remove();
				},1500);
				//delete view cart		
				jQuery('.list_add_to_cart .added_to_cart').remove();
			});	
		});	
		
		
		jQuery('body').bind( 'added_to_cart', function(event) {
			var _added_btn = jQuery('li.product').find('.add_to_cart_button.added').removeClass('added').addClass('added_btn');
			var _added_li = _added_btn.parent().parent().parent();
			_added_li.each(function(index,value){
				jQuery(value).trigger('wd_added_to_cart');
			});
			
			jQuery('.wd_tini_cart_wrapper').addClass('loading-cart');
			
			jQuery.ajax({
				type : 'POST'
				,url : _ajax_uri	
				,data : {action : 'update_tini_cart'}
				,success : function(respones){
					if( jQuery('.shopping-cart-wrapper').length > 0 ){
						jQuery('.shopping-cart-wrapper').html(respones);
						jQuery('.cart_dropdown,.form_drop_down').hide();
						jQuery('body').trigger('mini_cart_change');
						change_cart_items_mobile();
						setTimeout(function(){
							jQuery('.wd_tini_cart_wrapper').removeClass('loading-cart');
						},1000);
					}
				}
			});			
		} );			
		jQuery('.cart_dropdown,.form_drop_down').hide();
		change_cart_items_mobile();

		
		jQuery('.wd_tini_cart_wrapper,.wd_tini_account_wrapper').hoverIntent(
			function(){
				jQuery(this).children('.drop_down_container').slideDown(300);
			}
			,function(){
				jQuery(this).children('.drop_down_container').slideUp(300);
			}
		
		);

		jQuery('body').live('mini_cart_change',function(){
			jQuery('.wd_tini_cart_wrapper,.wd_tini_account_wrapper').hoverIntent(
				function(){
					jQuery(this).children('.drop_down_container').slideDown(300);
				}
				,function(){
					jQuery(this).children('.drop_down_container').slideUp(300);
				}
			
			);
		});	
			
			
		jQuery('input.subscribe_email').focus(function(event){
			if( jQuery(this).val() == "enter your email address" ){
				jQuery(this).val("");
			}
		});	
		jQuery('input.subscribe_email').blur(function(event){
			if( jQuery(this).val() == "" ){
				jQuery(this).val("enter your email address");
			}
		});	
        
        
        /*detail page*/
        if(jQuery("button.virtual.single_add_to_cart_button").length > 0){
			jQuery("button.virtual.single_add_to_cart_button").click(function(){
				//jQuery("form.product_detail").submit(); 
				 jQuery("form.product_detail").find('button.single_add_to_cart_button').trigger('click'); 
			});
		}
        jQuery('.variations_form').on('change','.variations select',function(event){
			setTimeout(function(){ 
				if(jQuery('div.single_variation_wrap').css('display') == 'block') {
					jQuery('button.single_add_to_cart_button.hidden-phone').removeClass('variable_hidden');
				} else {
					jQuery('button.single_add_to_cart_button.hidden-phone').addClass('variable_hidden');
				}
			}, 500);
		});
		
		setTimeout(function () {
			jQuery("div.shipping-calculator-form").show(400);
		}, 1500);
		
        /*
        if(jQuery("#calc_shipping_country").length > 0)	{
            jQuery("#calc_shipping_country").change(function(){
                if(jQuery("p.cart_state_heading").length > 0){
                    jQuery("p.cart_state_heading").remove();
                }
                setTimeout(function(){
                    if(jQuery("#calc_shipping_state:visible").length > 0 ){ 
                        var temp_p = '<p class="cart_state_heading">State/Province<abbr class="required" title="required">*</abbr></p>';
                        jQuery("#calc_shipping_state").parent().before(temp_p);
                    }     
                },30) ;
                 
            });
        }	
		*/
        
        /***** W3 Total Cache & Wp Super Cache Fix *****/
        jQuery('body').trigger('added_to_cart');
        /***** End Fix *****/
        
            /***** Start Re-init Cloudzoom on Variation Product  *****/
            jQuery('form.variations_form').live('found_variation',function( event, variation ){
                jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
            }).live('reset_image',function(){
                jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
            });
            /***** End Re-init Cloudzoom on Variation Product  *****/        
        
        /*************** End Woo Add On *****************/
        
        /*************** Disable QS in Main Menu *****************/
        jQuery('ul.menu').find('ul.products').addClass('no_quickshop');
        /*************** Disable QS in Main Menu *****************/
	 
        
		//product_label
		
		
		// _s_controller = jQuery.superscrollorama({triggerAtCenter: true});
		// jQuery('span.product_label').each(function(index,value){
			// _ele_bgcolor = jQuery(value).css('background-color');
			// _s_controller.addTween(jQuery(value), TweenMax.to( jQuery(value), .5, {css:{scare:1.5,opacity:1,top:26,height:"60px",width:"60px",right:-30,boxShadow: "0px 0px 6px 3px "+_ele_bgcolor,fontSize : 16 }, immediateRender:false,yoyo:true,repeat:1, ease:Power3.easeInOut}),100,0,true);
		// });
		
		
		// jQuery('.custom_category_shortcode > ul.products').children('li.product').hover(
			// function(){
				// TweenMax.to( jQuery(this), .9, {css:{opacity:1}})
			// }
			// ,function(){
				// TweenMax.to( jQuery(this), .9, {css:{opacity:0.7}})
			// }
		// );
		jQuery('div.custom_category_shortcode').each(function(index,value){
			// jQuery(value).children('ul.products').children('li.product').not('.featured_product_wrapper').each(function(li_index,li_value){
				// _s_controller.addTween(jQuery(li_value), TweenMax.from( jQuery(li_value), .9, {css:{opacity:0.7}, immediateRender:true, ease:Power3.easeInOut}));
			// });		
			// var _big_ele = jQuery(value).find('.featured_product_wrapper');
			// var _haft_container_width = _big_ele.width()/2;
			// _s_controller.addTween(jQuery(_big_ele), TweenMax.from( jQuery(_big_ele), .9, {css:{left:_haft_container_width}, immediateRender:true, ease:Power3.easeInOut}));
			// jQuery(value).children('ul.products').children('li.product').not('.featured_product_wrapper').each(function(li_index,li_value){
				// _s_controller.addTween(jQuery(li_value), TweenMax.from( jQuery(li_value), .9, {css:{opacity:0,right:"-100px"}, immediateRender:true, ease:Power3.easeInOut}));
			// });
		});
		
		
		/*************** End Woo Add On *****************/
		
		
		/*************** Start Product Rotate On *****************/
		
		// jQuery('li.product > a').hover(
			// function(event){
				// // TweenMax.to(jQuery(this).children('.product-image-front'), 3, {rotationY:180,ease:Power2.easeInOut});
				// // TweenMax.to(jQuery(this).children('.product-image-back'), 3, {css:{ opacity:1 },shortRotation:{rotationY:0,rotationX:0},ease:Power2.easeInOut });
				// // TweenMax.to( jQuery(value), 0.9, { css:{ right:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
			// }
			// ,function(event){
				// // TweenMax.to(jQuery(this).children('.product-image-front'), 3, {rotationY:0, transformOrigin:"left  50% -200"});
				// // TweenMax.to(jQuery(this).children('.product-image-back'), 3, {rotationY:180, transformOrigin:"left  50% -200"});
			// }
		// );
	
		
		/*************** End Product Rotate On *****************/
		
		
		if (jQuery.browser.msie && ( parseInt( jQuery.browser.version, 10 ) == 7 )){
			alert("Your browser is too old to view this interactive experience. You should take the next 30 seconds or so and upgrade your browser! We promise you'll thank us after doing so in having a much better and safer web browsing experience! ");
		}

		
		// jQuery('#MobileMainNavigation').live('change',function(event) {	
			// event.preventDefault();
			// window.location.href = jQuery(this).find('option:selected').val();
			
		// });
		em_search_bar();
		var windowWidth = jQuery(window).width();
		
		setTimeout(function () {
			  onSizeChange(windowWidth);
		}, 1000);	
		
        jQuery('a.block-control').click(function(){
            jQuery(this).parent().siblings().slideToggle(300);
            jQuery(this).toggleClass('active');
            return false;
        });
		
		
	
		jQuery('.related-slider').flexslider({
			animation: "slide"
		});
		
		jQuery('.tabbable > ul.nav.nav-tabs > li').bind('click',function(e){
			//e.isDefaultPrevented();
			jQuery(".tabbable").triggerHandler('tabs_change');
			//e.isPropagationStopped()
		});

		
		jQuery('li.shortcode').hover(function(){
			jQuery(this).addClass('shortcode_hover')},function(){jQuery(this).removeClass('shortcode_hover');});
		



		
		////////// Generate Tab System /////////
		if(jQuery('.tabs-style').length > 0){
			jQuery('.tabs-style').each(function(){
				var ul = jQuery('<ul></ul>');
				var divPanel = jQuery('<div></div>');
				var liChildren = jQuery(this).find('li.tab-item');
				var length = liChildren.length;
				divPanel.addClass('panel');
				jQuery(this).find('li.tab-item').each(function(index){
					jQuery(this).children('div').appendTo(divPanel);
					if(index == 0)
						jQuery(this).addClass('first');
					if(index == length - 1)
						jQuery(this).addClass('last');
					jQuery(this).appendTo(ul);
					
				});
				jQuery(this).append(ul);
				jQuery(this).append(divPanel);
				
					jQuery( this ).tabs({ fx: { opacity: 'toggle', duration:'slow'} }).addClass( 'ui-tabs-vertical ui-helper-clearfix' );
				
			});		
		}
		

		
		// Toggle effect for ew_toggle shortcode
		jQuery( '.toggle_container a.toggle_control' ).click(function(){
			if(jQuery(this).parent().parent().parent().hasClass('show')){
				jQuery(this).parent().parent().parent().removeClass('show');
				jQuery(this).parent().parent().parent().addClass('hide');
				jQuery(this).parent().parent().children('.toggle_content ').hide('slow');
			}
			else{
				jQuery(this).parent().parent().parent().addClass('show');
				jQuery(this).parent().parent().parent().removeClass('hide');
				jQuery(this).parent().parent().children('.toggle_content ').show('slow');
			}
				
		});
		
        
        
        //fancy box
        $fancy_wd = jQuery("a.fancybox").fancybox({
			// 'openEffect'	: 'elastic'
			// ,'closeEffect'	: 'elastic'
			// ,'openEasing'   : 'easeOutBack'
			// ,'closeEasing'  : 'easeOutBack'
			// ,'nextEasing'   : 'easeOutBack'
			// ,'prevEasing'	: 'easeOutBack'		
			// 'openSpeed'    : 500
			// ,'openSpeed'	: 500
			// ,'nextSpeed'	: 1000
			// ,'prevSpeed'    : 1000
			'scrolling'	: 'no'
			,'mouseWheel'	: false

			,beforeLoad  : function(){
					tmp_href = this.href;
					if( this.href.indexOf('youtube.com') >= 0 || this.href.indexOf('youtu.be') >= 0 ){
						this.type = 'iframe';
						this.scrolling = 'no';
						//&html5=1&wmode=opaque
						this.href = this.href.replace(new RegExp("watch\\?v=", "i"), 'embed/') + '?autoplay=1';
					}
					else if( this.href.indexOf('vimeo.com') >= 0 ){
						this.type = 'iframe';
						this.scrolling = 'no';					
						//this.href = this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1') + '&autoplay=1';
						var regExp = /http:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
						var match = this.href.match(regExp);
						this.href = 'http://player.vimeo.com/video/' + match[2] + '?portrait=0&color=ffffff';
					}
					else{
						//this.type = null;
					}
					
					
			}
			,afterClose : function(){
					this.href = tmp_href;
			}		
			,afterShow  : function(){
				jQuery('.fancybox-wrap').wipetouch({
					tapToClick: true, // if user taps the screen, triggers a click event
					wipeLeft: function(result) { 
						jQuery.fancybox.next();
					},
					wipeRight: function(result) {
						jQuery.fancybox.prev();
					}
				});					
				if( jQuery('.fancybox-prev-clone').length <= 0 )
					jQuery('.fancybox-prev').clone().removeClass('fancybox-nav fancybox-prev').addClass('fancybox-prev-clone').appendTo(".fancybox-overlay");
				
				if( jQuery('.fancybox-next-clone').length <= 0 )
					jQuery('.fancybox-next').clone().removeClass('fancybox-nav fancybox-next').addClass('fancybox-next-clone').appendTo(".fancybox-overlay");
				
				if( jQuery('.fancybox-close-clone').length <= 0 )
					jQuery('.fancybox-close').clone().removeClass('fancybox-item fancybox-close').addClass('fancybox-close-clone').appendTo(".fancybox-overlay");
			
				if( jQuery('.fancybox-title-clone').length <= 0 )
					jQuery('.fancybox-title').clone().addClass('fancybox-title-clone').appendTo(".fancybox-overlay");
				else{
					jQuery('.fancybox-title-clone').html( jQuery('.fancybox-wrap').find('.fancybox-title').html() );
				}	
				jQuery('.fancybox-wrap').find('.fancybox-title').hide();				
				
				jQuery('.fancybox-wrap').find('.fancybox-prev').hide();
				jQuery('.fancybox-wrap').find('.fancybox-next').hide();
				jQuery('.fancybox-wrap').find('.fancybox-close').hide();
				
			}			
			
		}); 
        
        jQuery('.fancybox-prev-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-prev').trigger('click');
		});
		jQuery('.fancybox-next-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-next').trigger('click');
		});
		jQuery('.fancybox-close-clone').live('click',function(){
			jQuery('.fancybox-wrap').find('.fancybox-close').trigger('click');
		});
        
        

		jQuery('p:empty').remove();
		
		// button state demo
		jQuery('.btn-loading')
		  .click(function () {
			var btn = jQuery(this)
			btn.button('loading')
			setTimeout(function () {
			  btn.button('reset')
			}, 3000)
		  });
		
		// tooltip 
		jQuery('body').tooltip({
		  selector: "a[rel=tooltip]"
		});
	 

		
		if( jQuery('html').offset().top < 100 ){
			jQuery("#to-top").hide();
		}
		jQuery(window).scroll(function () {
			
			if (jQuery(this).scrollTop() > 100) {
				jQuery("#to-top").fadeIn();
			} else {
				jQuery("#to-top").fadeOut();
			}
		});
		jQuery('.scroll-button').click(function(){
			jQuery('body,html').animate({
			scrollTop: '0px'
			}, 1000);
			return false;
		});			

		
		jQuery('#myTab a').click(function (e) {
			e.preventDefault();
			jQuery(this).tab('show');
		});
	
		//call review form
		jQuery('.woocommerce-review-link').click(function(){
			if(jQuery('.woocommerce-tabs').length > 0){
				jQuery('.review_form_wrapper').trigger('focus');
			}
		})

			
		jQuery('.carousel').each(function(index,value){
			jQuery(value).wipetouch({
				tapToClick: false, // if user taps the screen, triggers a click event
				wipeLeft: function(result) { 
					jQuery(value).find('a.carousel-control.right').trigger('click');
					//jQuery(value).carousel('next');
				},
				wipeRight: function(result) {
					jQuery(value).find('a.carousel-control.left').trigger('click');
					//jQuery(value).carousel('prev');
				}
			});	
		});
		
		
		// jQuery("ul.social-share > li > a > span").css("position","relative").css("right","500px").css("opacity","0");
		// jQuery("ul.social-share > li > a > span").each(function(index,value){
			// TweenMax.to( jQuery(value), 0.9, { css:{ right:"0px",opacity:1 },  ease:Power2.easeInOut ,delay:index*0.9});
		// });
		
        set_cloud_zoom();
		// Set menu on top
		//sticky_main_menu( on_touch );
		if( on_touch == 0 ){
			jQuery(window).bind('resize',jQuery.throttle( 250, 
				function(){
					if( !( jQuery.browser.msie &&  parseInt( jQuery.browser.version, 10 ) <= 7 ) ){
						onSizeChange( jQuery(window).width() );
                        set_header_bottom();
						set_cloud_zoom();
						menu_change_state( jQuery('body').innerWidth() );	
					}
				})
			);
		}else{
			jQuery(window).bind('orientationchange',function(event) {	
					onSizeChange( jQuery(window).width() );
                    set_header_bottom();
					set_cloud_zoom();
					menu_change_state( jQuery('body').innerWidth() );				
			});
		}

		if(jQuery('body.single-post').length > 0)	{
			var left_height = 0;
			var  right_height = 0;
			var  main_height = 0;
			if(jQuery('#left-sidebar').length > 0 )
				left_height = jQuery('#left-sidebar').height();
			if(jQuery('#right-sidebar').length > 0 )
				right_height = jQuery('#right-sidebar').height();
			if(jQuery('#main').length > 0 )
				main_height = jQuery('#main').height();
			var max = Math.max(left_height,right_height,main_height);	
			
			if(jQuery('#left-sidebar').length > 0 )
				jQuery('style#custom-background-css').append('#left-sidebar:after{height:'+max+'px;}');
            if(jQuery('#right-sidebar').length > 0 )
				jQuery('style#custom-background-css').append('#right-sidebar:before{height:'+max+'px;}');
		}
        
		jQuery(".right-sidebar-content > ul > li:first").addClass('first');
		jQuery(".right-sidebar-content > ul > li:last").addClass('last');
		
		
		jQuery(".product_upsells > ul").each(function( index,value ){
			jQuery(value).children("li:last").addClass('last');
		});
		

		jQuery("ul.product_list_widget").each(function(index,value){
			jQuery(value).children("li:first").addClass('first');
			jQuery(value).children("li:last").addClass('last');
		});
		jQuery(".related.products > ul > li:last").addClass('last');
		
		
		jQuery("a.wd-prettyPhoto").prettyPhoto({
				social_tools: false,
				theme: 'pp_woocommerce',
				horizontal_padding: 40,
				opacity: 0.9,
				deeplinking: false
			});
						
});

