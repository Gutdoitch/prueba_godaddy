(function($){
    'use strict';

    /*----- ELEMENTOR LOAD FUNCTION CALL ---*/

    $( window ).on( 'elementor/frontend/init', function() {

       // Initial

        var Beforeafter = function (){
        // You can put any js function here without windows on load
        
         new BeerSlider( document.getElementById( "mayosis-before-after" ), {start: 50} );

        }
        
        
        
        
        var ClientProgessP = function (){
                    // on page load...
            moveProgressBar();
            // on browser resize...
            $(window).resize(function() {
                moveProgressBar();
            });
        
            // SIGNATURE PROGRESS
            function moveProgressBar() {
              console.log("moveProgressBar");
                var getPercent = ($('.progress-wrap').data('progress-percent') / 100);
                var getProgressWrapWidth = $('.progress-wrap').width();
                var progressTotal = getPercent * getProgressWrapWidth;
                var animationLength = 2500;
                
                // on page load, animate percentage bar to data percentage length
                // .stop() used to prevent animation queueing
                $('.progress-bar').stop().animate({
                    left: progressTotal
                }, animationLength);
            }
            
        }
        
        var Testimonialm = function (){
            
        // You can put any js function here without windows on load
         var swiper = new Swiper("#carousel-testimonial-elmentor", {
           loop: true,
   slidesPerView: 'auto',
   centeredSlides: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          type: 'bullets',
           dynamicBullets:true,
        },
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
      });

        }
        
 
         // Text slider
        var MayosisTextSlider = function () {
            // Text Slider

                
       /**
	 * Horizontal Scrolling
	 */
	const scrollers = document.querySelectorAll(".scroller-x");
	scrollers.forEach((scroller) => {
		scroller.setAttribute("data-animated", true);
		const scrollerInner = scroller.querySelector(".scroller-x__list");
		const scrollerContent = Array.from(scrollerInner.children);
		scrollerContent.forEach((item) => {
			const duplicatedItem = item.cloneNode(true);
			duplicatedItem.setAttribute("aria-hidden", true);
			scrollerInner.appendChild(duplicatedItem);
		});
	});
       
   
	/**
	 * Vertical Scrolling
	 */
	const scrollersY = document.querySelectorAll(".scroller-y");
	scrollersY.forEach((scroller) => {
		scroller.setAttribute("data-animated", true);
		const scrollerInner = scroller.querySelector(".scroller-y__list");
		const scrollerContent = Array.from(scrollerInner.children);
		scrollerContent.forEach((item) => {
			const duplicatedItem = item.cloneNode(true);
			duplicatedItem.setAttribute("aria-hidden", true);
			scrollerInner.appendChild(duplicatedItem);
		});
	});
	

        }
        
    
 var Productslider = function (){
        // You can put any js function here without windows on load
     
    
          var productsliderMsv = new Swiper("#carousel-product-msv-elmentor", {
           loop: true,
   slidesPerView: 1,
   centeredSlides: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          type: 'bullets',
          dynamicBullets:true,
        },
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
      });
    

        }
        
        
        var Productcarousel = function (){
        // You can put any js function here without windows on load
        
    
    
    
        var swiper = new Swiper("#product--carousel--elementor--d", {
   slidesPerView: 'auto',
   centeredSlides: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
          type: 'bullets',
        },
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
      });
    
    
        }
        
        
    
    var Catcarousel = function (){
        // You can put any js function here without windows on load
        
        
            var catgrid3 = new Swiper(".grid-cat-edd-3", {
   slidesPerView: 3,
    spaceBetween:15,
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
   breakpoints: {
          200: {
            slidesPerView:1,
          },
          768: {
            slidesPerView: 3,

          },
          1024: {
            slidesPerView: 3,
        
          },
          
           1366: {
            slidesPerView: 3,
        
          },
          
          1499: {
            slidesPerView: 3,
        
          },
        },
      });
    
        
        
                var catgrid4 = new Swiper(".grid-cat-edd-4", {
   slidesPerView: 4,
   spaceBetween:15,
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
   breakpoints: {
          200: {
            slidesPerView:1,
          },
          768: {
            slidesPerView: 4,

          },
          1024: {
            slidesPerView: 4,
        
          },
          
           1366: {
            slidesPerView: 4,
        
          },
          
          1499: {
            slidesPerView: 4,
        
          },
        },
      });
    
    
  
  
          var catgrid5 = new Swiper(".grid-cat-edd-5", {
   slidesPerView: 5,
    spaceBetween:15,
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
   breakpoints: {
          200: {
            slidesPerView:1,
          },
          768: {
            slidesPerView: 5,

          },
          1024: {
            slidesPerView: 5,
        
          },
          
           1366: {
            slidesPerView: 5,
        
          },
          
          1499: {
            slidesPerView: 5,
        
          },
        },
      });
      
      
       var catgrid6 = new Swiper(".grid-cat-edd-6", {
   slidesPerView: 6,
    spaceBetween:15,
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
  
   breakpoints: {
          200: {
            slidesPerView:1,
          },
          768: {
            slidesPerView: 5,

          },
          1024: {
            slidesPerView: 5,
        
          },
          
           1366: {
            slidesPerView: 6,
        
          },
          
          1499: {
            slidesPerView: 6,
        
          },
        },
      });
    
    
    
     var catgrid7 = new Swiper(".grid-cat-edd-7", {
   slidesPerView: 7,
   spaceBetween:15,
        navigation: {
    nextEl: '.elementor-swiper-button-next',
    prevEl: '.elementor-swiper-button-prev',
  },
  
   breakpoints: {
          200: {
            slidesPerView:1,
          },
          768: {
            slidesPerView: 5,

          },
          1024: {
            slidesPerView: 5,
        
          },
          
           1366: {
            slidesPerView: 6,
        
          },
          
          1499: {
            slidesPerView: 7,
        
          },
        },
      });

    
    
    }

        //BeforeAfter
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mayosis-before-after.default', function($scope, $){
            Beforeafter();
        } );
        
        
        //Testiminial
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mayosis-theme-testimonial.default', function($scope, $){
            Testimonialm();
        } );
        
        
        //product Slider
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mayosis-edd-slider.default', function($scope, $){
            Productslider();
        } );
        
        
         //product Carousel
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mayosis-edd-carousel.default', function($scope, $){
            Productcarousel();
        } );
        
        
         //Category Carousel
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mayosis-edd-category.default', function($scope, $){
            Catcarousel();
        } );
        
        
          //Category Carousel
        elementorFrontend.hooks.addAction( 'frontend/element_ready/mayosis-woo-category.default', function($scope, $){
            Catcarousel();
        } );
        
    
        
        
           //Text Slider
        elementorFrontend.hooks.addAction("frontend/element_ready/mayosis_text_slider.default", function ($scope, $) {
            MayosisTextSlider()
        });
        
        
          //Client Progress
        elementorFrontend.hooks.addAction("frontend/element_ready/mayosis_popular_client_block.default", function ($scope, $) {
            ClientProgessP()
        });

   

 } );
})(jQuery);
