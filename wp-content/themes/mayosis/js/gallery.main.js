jQuery(document).ready(function($){
     var galleryThumbssalad = new Swiper('.mayosis-gallery-thumbnail-default', {
   spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
      touchRatio: 0.2,
      slideToClickedSlide: true,
			loop: true,
			loopedSlides: 50
  });
  
var galleryTop = new Swiper('.mayosis-product-gallery-main-bx', {
     slidesPerView: 1,
    centeredSlides: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    spaceBetween: 10,
    keyboard: {
    enabled: true,
    onlyInViewport: false,
  },
    loop: true,
			loopedSlides: 50,
    pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
        clickable: true,
    },
   
});
     if (document.querySelector(".mayosis-product-gallery-main-bx")) {
    galleryTop.controller.control = galleryThumbssalad;
    galleryThumbssalad.controller.control = galleryTop;
     }



var galleryWtThumb = new Swiper('.mayosis-product-gallery-main-bx-wt-thumb', {
     slidesPerView: 1,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    spaceBetween: 10,
    keyboardControl: true,
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
        clickable: true,
    },
});



var galleryCarouselmsb = new Swiper('.mayosis-product-gallery-main-bx-carousel', {
     slidesPerView: 3,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    spaceBetween: 10,
    keyboardControl: true,
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
        clickable: true,
    },
});



var galleryThumnailSlides = new Swiper('.mayosis-product--gallery--thumnail_msb', {
     slidesPerView: 1,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    spaceBetween: 10,
    keyboardControl: true,
    loop: true,
    
    pagination: {
          el: ".swiper-pagination",
          dynamicBullets: true,
          clickable:true
        },
});
    
      

var gallerySideMain = new Swiper('.mayosis-product-gallery-main-bx-side-thumbs', {
			slidesPerView: 1,  
      loop: true,
      loopedSlides: 50,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      
       pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
        clickable: true,
    },
    
   
      
    });
    
    
     var gallerySideThumbs = new Swiper('.mayosis-gallery-thumbnail-sidethumbs', {
   direction: 'vertical',
      slidesPerView: 5,
      slideToClickedSlide: true,
      spaceBetween: 10,
      loopedSlides: 50,
      loop: true,
  });
    
     if (document.querySelector(".mayosis-product-gallery-main-bx-side-thumbs")) {
    gallerySideMain.controller.control = gallerySideThumbs;
gallerySideThumbs.controller.control = gallerySideMain;
}
    

    

    jQuery(".swiper-slide-zoom").click(function(event) {

        jQuery(event.target).closest(".mayosis-main-product-slide-box-mcd").addClass("social-share-hide");
        jQuery(event.target).closest(".swiper-container").addClass("fullscreen");
        setTimeout(function() {
            galleryTop.update();
        }, 1);
        
        setTimeout(function() {
            galleryWtThumb.update();
        }, 1);
        
        
          setTimeout(function() {
            gallerySideMain.update();
        }, 1);
        
        
         setTimeout(function() {
            galleryCarouselmsb.update();
        }, 1);
        
    });

jQuery(".close-button").click(function(event) {
    jQuery(".mayosis-main-product-slide-box-mcd").removeClass("social-share-hide");
    jQuery(".swiper-container").removeClass("fullscreen");
	setTimeout(function() {
            galleryTop.update();
        }, 1);
        
        setTimeout(function() {
            galleryWtThumb.update();
        }, 1);
        
         setTimeout(function() {
            gallerySideMain.update();
        }, 1);
        
         setTimeout(function() {
            galleryCarouselmsb.update();
        }, 1);
});
    

});