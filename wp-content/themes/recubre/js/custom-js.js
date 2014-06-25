jQuery(document).ready(function() {
	/* Sub menu on header */

	if(jQuery(".menu li.menu-item-has-children .sub-menu").css("display") == "block"){
 		alert("submenu visible");
 		jQuery(".menu li.menu-item-has-children").addClass("active");
	}
   
    if(jQuery( ".menu li.menu-item-has-children span.visible-phone" ).hasClass("active")){
    	alert("submenuuu");
    }

    jQuery( ".menu li.menu-item-has-children .sub-menu" ).hover(
	  function() {
	  	jQuery(this).siblings("a").addClass("sub-menu-hover");
	  }, function() {
	    jQuery(this).siblings("a").removeClass("sub-menu-hover");
	  }
	);
	//alert(jQuery(".menu li.menu-item-has-children span.visible-phone.active").parent().html());
 });

jQuery(document).load(function () {
 // code here
   if(jQuery(".menu li.menu-item-has-children .sub-menu").css("display") == "block"){
 		alert("submenu visible");
 		jQuery(".menu li.menu-item-has-children").addClass("active");
	}
	    if(jQuery( ".menu li.menu-item-has-children span.visible-phone" ).hasClass("active")){
    	alert("submenuuu");
    }
});


if(jQuery(".menu li.menu-item-has-children .sub-menu").css("display") == "block"){
 		alert("submenu visible");
 		jQuery(".menu li.menu-item-has-children").addClass("active");
	}