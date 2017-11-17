(function($){
	$( window ).load( function( ) {
		var transparent = true;

		//
		// Various Global JS
		//

				// Open external links in new window
				$('a:link:not([href*="mailto"])').each(function() {
				   var a = new RegExp('/' + window.location.host + '/');
				   if(!a.test(this.href)) {
				       	$(this).click(function(event) {
				           event.preventDefault();
				           event.stopPropagation();
				           window.open(this.href, '_blank');
				       });
				   }
				});

				// Lets smooth out incoming anchor links
				var urlHash = window.location.href.split("#")[1];
		    	if (urlHash &&  $('#' + urlHash).length ) {
			        $('html,body').animate({
			            scrollTop: $('#' + urlHash).offset().top - 80
			        }, 400);
				}

				// Lets smooth anchor link scrolling CC Chris Coyer
				$('a[href*="#"]:not([href="#"])').click(function() {
			    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			      if (target.length) {
			        $('html, body').animate({
			          scrollTop: target.offset().top - 80
			        }, 500);
			        return false;0
			      }
			    }
			  });


		//
		// Navigation Header JS
		//

			$(".menu-toggle").click(function() {
				menuToggle();
			});

			$(".header-center-menu li a").click(function() {
				if(($(document).width()) < 1000) {
					menuToggle();
				}
			});

			function menuToggle() {
				$(".menu-toggle").toggleClass("cross");

				if($('.mobile-pullout').css('display') == 'none') {
					$('.mobile-pullout').css("display", "flex").hide().fadeIn();
					$("body").css("overflow", "hidden");
					$("body").addClass("overlay-open");
				}
				else {
					$('.mobile-pullout').fadeOut();
					$("body").css("overflow", "auto");
					$("body").removeClass("overlay-open");
				}
			}

				var url = window.location.href;
				var urlSplit = url.split("?");
				$(window).scroll(checkStickyHeader);
				checkStickyHeader();
				function checkStickyHeader() {
					if($(document).scrollTop() > 100 ) {

						if(transparent) {
								transparent = false;
								$('header').addClass('is-sticky');
								$('header').css('z-index', '7');
						}

						var topNum = 150 - $(document).scrollTop();
					} else {
						if( !transparent ) {
							transparent = true;
							$('header').removeClass('is-sticky');
						}
					}
				}



			//
			// Modal JS
			//

				$( ".modal-trigger" ).click(function() {
					var modal = '#' + $(this).data("target");
					$(modal).fadeIn();
					$("body").css("overflow", "hidden");
					$("body").addClass("overlay-open");
				});
				$(document).keyup(function(e) {
		      if (e.keyCode === 27) {
						$(".et_pb_section.modals .et_pb_row").each(function() {
							if($( this ).css("display") == "block") {
								$( this ).fadeOut();
							}
						});
						$("body").css("overflow", "auto");
						$("body").removeClass("overlay-open");
			    }
				});
				$( ".et_pb_section.modals .et_pb_text" ).each(function() {
				  $( this ).prepend( "<span class='close-overlay'></span>" );
				});

				$('.close-overlay').click(function(e){
					e.stopPropagation();
					var parent = $(this).parent().parent().parent();
					parent.fadeOut();
					$("body").css("overflow", "auto");
					$("body").removeClass("overlay-open");
				});


	});

})(jQuery);
