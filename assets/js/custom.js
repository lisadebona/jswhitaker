/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	

    var swiper = new Swiper('.swiper-container', {
      spaceBetween: 0,
      centeredSlides: true,
      direction: 'horizontal',
      loop:true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    $(document).on("click",".acctitle",function(){
    	var parent = $(this).parents(".acc-item");
    	var childText = parent.find(".acctext");
    	$(".acctext").not(childText).slideUp('slow');
    	$(".acc-item").removeClass('open');
    	$(".acctitle").removeClass('open');
    	parent.find(".acctitle").toggleClass('open');
    	parent.find(".acctext").slideToggle('slow');
    });

    $(document).on("click","#collapseAll",function(e){
    	e.preventDefault();
    	$(this).toggleClass('open');
    	if( $(this).hasClass('open') ) {
    		$(this).text('Close All');
    		$(".acc-item").each(function(){
	    		$(this).find(".acctext").show();
	    		$(this).find(".acctitle").addClass('open');
	    	});
    	} else {
    		$(this).text('Collapse All');
			$(".acc-item").each(function(){
				$(this).find(".acctext").hide();
				$(this).find(".acctitle").removeClass('open');
			});
    	}
    });
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	

	$(document).on("click",".menu-toggle",function(){
		$(this).toggleClass('open');
		$('body').toggleClass('open-mobile-menu');
		$(".main-navigation").toggleClass('open');
	});

});// END #####################################    END