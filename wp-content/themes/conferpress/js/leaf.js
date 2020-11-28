(function($) {
"use strict";
	$(document).ready(function(e) {
		$('.top-tab-link').on("click",function() {
			$('.top-tab-link').removeClass('active');
			$(this).addClass('active');
		});
		//search toggle focus
		$('.search-toggle').on("click",function(e) {
			$('body').toggleClass('enable-search');
			setTimeout(function(){
				if($('body').hasClass('enable-search')){
					$('input.search-field').focus();
				}
				},300
			)
			return false;
		});
		//improve mobile menu
		$('.mobile-menu li a').on("click",function(){
			$('body').removeClass('enable-mobile-menu');
		});

		//carousel
		$(".init-carousel").each(function(){
			var carousel_id = $(this).attr('id');
			var auto_play = $(this).data('autoplay');
			var items = $(this).data('items');
			var navigation = $(this).data('navigation');
			if($(this).hasClass('single-carousel')){ //single style
				var owl = $(this).owlCarousel({
					singleItem:true,
					autoHeight: true,
					autoPlay: auto_play,
					navigation: navigation?true:false,
					navigationText:["<i class='lnr lnr-chevron-left'></i>","<i class='lnr lnr-chevron-right'></i>"],
					addClassActive : true,
					stopOnHover: true,
					slideSpeed : 600,
				});
			}else{
				var owl = $(this).owlCarousel({
					autoPlay: auto_play,
					items: items?items:4,
					itemsDesktop: items?false:4,
					singleItem: items==1?true:false,
					navigation: navigation?true:false,
					navigationText:["<i class='lnr lnr-chevron-left'></i>","<i class='lnr lnr-chevron-right'></i>"],
					slideSpeed: 500,
					addClassActive : true,
					afterInit: leaf_owl_update,
					afterUpdate : leaf_owl_update,
				});
			}
			$(window).load(function(e) { //fix vc strech row
				setTimeout(function() {
					owl.data('owlCarousel').updateVars();
				}, 50);

				//RTL
				if($('body').hasClass('rtl')){
					owl.data('owlCarousel').jumpTo(-1);
				}
			});
		});
		
		function leaf_owl_update(this_owl){
			if($('.header-carousel-item').length){
				$('.header-carousel-item').each(function(index, element) {
					var width = $(this).outerWidth();
					var c_height = $(this).parent().next('.owl-item').outerHeight();
					if(!c_height){
						c_height = $(this).parent().prev('.owl-item').outerHeight();
					}
					var padding = (c_height - 20)/width*100;
					$('.header-carousel-item-inner',this).css('padding-top',padding+'%');
				});
			}
		}
		//post slider
		$('.post-slider-prev').on("click",function(e) {
			var owl = $(this).closest('.post-slider-carousel').data('owlCarousel');
			owl.prev();
			return false;
	    });
		$('.post-slider-next').on("click",function(e) {
			var owl = $(this).closest('.post-slider-carousel').data('owlCarousel');
			owl.next();
			return false;
	    });
		
		//grid turn to carousel
		if($(window).width()<977){
			$(".grid-listing").owlCarousel({ addClassActive : true });
		}
		
		//Countdown
		$('[data-countdown]').each(function() {
			var $this = $(this), finalDate = $(this).data('countdown');
			var day_label = $this.data('daylabel');
			var hour_label = $this.data('hourlabel');
			var minute_label = $this.data('minutelabel');
			var second_label = $this.data('secondlabel');
			var show_second = $this.data('showsecond');
			$this.countdown(finalDate, {elapse: true})
			  .on('update.countdown', function(event) {
				if (event.elapsed) { // Either true or false
				  $this.html(event.strftime(''
					+ '<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%D</span><span class="countdown-label main-color-1">'+day_label+'</span></span>'
					+ '<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%H</span><span class="countdown-label main-color-1">'+hour_label+'</span></span>'
					+ '<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%M</span><span class="countdown-label main-color-1">'+minute_label+'</span></span>'
					+ (show_second?'<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%S</span><span class="countdown-label main-color-1">'+second_label+'</span></span>':'')
				));
				} else {
				  $this.html(event.strftime(''
					+ '<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%D</span><span class="countdown-label main-color-1">'+day_label+'</span></span>'
					+ '<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%H</span><span class="countdown-label main-color-1">'+hour_label+'</span></span>'
					+ '<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%M</span><span class="countdown-label main-color-1">'+minute_label+'</span></span>'
					+ (show_second?'<span class="countdown-block"><span class="countdown-number main-color-1-bg dark-div minion">%S</span><span class="countdown-label main-color-1">'+second_label+'</span></span>':'')
				));
				}
			});
		});
		if($('.colorbox-grid').length){
			$('.colorbox-grid').colorbox({
				rel: function(){
					return $(this).data('rel');
				},
				inline:true,
				href: function(){
					if($(this).data('isgallery')){
						return $(this).data('content')+' .popup-data-gallery';
					}else{
						return $(this).data('content')+' .popup-data:not(.popup-data-gallery)';
					}
				},
				width: 900,
				responsive: true,
				onOpen: function(){
					$('body').addClass('popup-active');
				},
				onClosed: function(){
					$('body').removeClass('popup-active');
				},
				previous: '<i class="fa fa-chevron-left"></i>',
				next: '<i class="fa fa-chevron-right"></i>',
				close: '<i class="fa fa-times"></i>',
			});
		}
		
		//mobile menu
		$('.mobile-menu-toggle').on("click",function(e) {
	        $('body').toggleClass('enable-mobile-menu');
			return false;
	    });
		$(document).mouseup(function(e){
			var container = $(".mobile-menu-wrap, #off-canvas-search");
			if (!container.is(e.target) && container.has(e.target).length === 0){
				$('body').removeClass('enable-mobile-menu');
			}
		});
		
		//smooth link #
		$('a[href*="#"]:not([href="#"])').on("click",function() {
			if($(this).hasClass('featured-tab') || $(this).hasClass('popup-gallery-comment')
			 || $(this).parents('ul').hasClass('tabs') || $(this).hasClass('comment-reply-link') || $(this).hasClass('ui-tabs-anchor')
			 || $(this).data('vc-container') || $(this).parents('div').hasClass('wpb_tour_next_prev_nav')
			 || $(this).hasClass('vc_carousel-control')){
				return true;
			}else if(location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
				|| location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				   if (target.length) {
					$('html,body,#body-wrap').animate({
						 scrollTop: target.offset().top - 120
					}, 660);
					return true;
				}
			}
		});

		$('.eventon-heading-ticket-anchor').on('click', function(){
            $('html,body,#body-wrap').animate({
                scrollTop: $('.evo_metarow_tix').offset().top - 100
            }, 660);
            return false;
        });
		
		$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" id="add1" class="plus" />' ).prepend( '<input type="button" value="-" id="minus1" class="minus" />' );
		$('.buttons_added #minus1').on("click",function(e) {
			var value = parseInt($(this).siblings('input[type="number"]').val()) - 1;
			if(value>=0){
				$(this).siblings('input[type="number"]').val(value).trigger("change");
				$('.woocommerce-cart table.cart input[name="update_cart"]').prop("disabled", false);
			}
	    });
		$('.buttons_added #add1').on("click",function(e) {
			var value = parseInt($(this).siblings('input[type="number"]').val()) + 1;
			$(this).siblings('input[type="number"]').val(value).trigger("change");
			$('.woocommerce-cart table.cart input[name="update_cart"]').prop("disabled", false);
	    });
	    //cart ajax fix
	    $( document.body ).on( 'updated_cart_totals', function(){
			$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" id="add1" class="plus" />' ).prepend( '<input type="button" value="-" id="minus1" class="minus" />' );
			$('.buttons_added #minus1').on("click",function(e) {
				var value = parseInt($(this).siblings('input[type="number"]').val()) - 1;
				if(value>=0){
					$(this).siblings('input[type="number"]').val(value).trigger("change");
					$('.woocommerce-cart table.cart input[name="update_cart"]').prop("disabled", false);
				}
		    });
			$('.buttons_added #add1').on("click",function(e) {
				var value = parseInt($(this).siblings('input[type="number"]').val()) + 1;
				$(this).siblings('input[type="number"]').val(value).trigger("change");
				$('.woocommerce-cart table.cart input[name="update_cart"]').prop("disabled", false);
		    });
		});
		
		
		$(document).mouseup(function(e){
			var container = $("#off-canvas-search form");
			if (!container.is(e.target) && container.has(e.target).length === 0){
				$('body').removeClass('enable-search');
			}

		});

		/*comment heading*/
		$('.comments-area .comment-reply-link').on("click",function() {
			$('.comments-area .comment-form .ia-heading').hide();
		});
		$('.comments-area #cancel-comment-reply-link').on("click",function() {
			$('.comments-area .comment-form .ia-heading').show();
		});
		
		
	});//document ready

	$(window).resize(function(e) {
		if($(window).width()<977){
			$(".grid-listing").each(function(index, element) {
				if(!$(this).hasClass('owl-carousel')){
					$(this).owlCarousel({ addClassActive : true });
				}
			});
		}else{
			$(".grid-listing").each(function(index, element) {
	            if($(this).hasClass('owl-carousel')){
					var owl = $(this).data('owlCarousel');
					owl.destroy();
				}
	        });
		}
	});

	$(window).scroll(function(e) {
		if( $(window).width() > 991 && $('.summary.portrait-screenshot').length){
			var scrollTop = $(window).scrollTop();
			
			var box_height = $('.summary.portrait-screenshot').outerHeight();
			var box_offset = $('.summary.portrait-screenshot').offset().top;
			
			var mobile_height = $('.images .ias-devide-wrap').height();
			var mobile_offset = $('.images .ias-devide-wrap').offset().top;
			
			var menu_height = 50 + $('#wpadminbar').height();

			if( mobile_offset - scrollTop - menu_height - 30 <=0 ){
				margin_top = scrollTop - mobile_offset + menu_height + 30;
				if(margin_top >= mobile_height - box_height){
					margin_top = mobile_height - box_height;
				}
			}else{
				margin_top = 0;
			}
			$('.summary.portrait-screenshot').css('margin-top',margin_top);
		}else{
			$('.summary.portrait-screenshot').css('margin-top',0);
		}
	});

	// Get browser add body class
	$.each($.browser, function(i) {
	    $('body').addClass(i);
	    return false;  
	});
	// Get OS
	var os = [
	    'iphone',
	    'ipad',
	    'windows',
	    'mac',
	    'linux',
		'android',
		'mobile'
	];
	var match = navigator.appVersion.toLowerCase().match(new RegExp(os.join('|')));
	if (match) {
	    $('body').addClass(match[0]);
	    if(typeof match[0] == 'undefined'){
			match[0]='';
		}
	}

	if ( (navigator.appVersion.indexOf("Win")!=-1 || navigator.appVersion.indexOf("Mac")!=-1 || navigator.appVersion.indexOf("X11")!=-1 || match[0]=='windows' || match[0]=='mac') && match[0]!='iphone' && match[0]!='ipad'){
		$('body').addClass('pc');
	}else{
		$('body').addClass('mobile');
	}
	//End body class

	//Loading effect
	setTimeout(function() {
		$('#pageloader').fadeOut();
	}, 30000);
	$(window).load(function(e) {
		$("#pageloader").fadeOut(500);
	});

//use strict
})(jQuery);