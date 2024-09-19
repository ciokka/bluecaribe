document.addEventListener("DOMContentLoaded", function() {
    var thumbSlider, mainSlider, reviewSlider;
  
       
    var thumbSliderEl = document.querySelector(".thumb-slider");
    if (thumbSliderEl) {
        thumbSlider = new Swiper(thumbSliderEl, {
            spaceBetween: 15,
            slidesPerView: 8,
            freeMode: true, // Attiva lo scorrimento libero
            // freeModeMomentum: true,
             watchSlidesVisibility: true,
             watchSlidesProgress: true,
            slideToClickedSlide: true,
            // freeModeMomentumRatio: 0.5, // Regola la velocità di inerzia
            // freeModeSticky: true, // Blocca i slide alla fine dello scorrimento
            // touchStartPreventDefault: false,
            breakpoints: {
                600: {
                    slidesPerView: 3
                },
                601: {
                    slidesPerView: 5
                },
                1101: {
                    slidesPerView: 8, // Mostra 8 immagini sopra i 1100px
                }
            }
        });
    }
    // thumbSliderEl.addEventListener('touchstart', function(e) {
    //     e.stopPropagation();
    // }, { passive: true });
    
    // thumbSliderEl.addEventListener('touchmove', function(e) {
    //     e.stopPropagation();
    // }, { passive: true });
    // Inizializzazione main-slider
    var mainSliderEl = document.querySelector(".main-slider");
    if (mainSliderEl && thumbSlider) {
        mainSlider = new Swiper(mainSliderEl, {
            loop: true,
            spaceBetween: 15,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: thumbSlider, // Collega il thumb-slider al main-slider
            }
        });
    }
   
    // Inizializzazione review-slider
    if (document.querySelector(".review-slider")) {
        reviewSlider = new Swiper(".review-slider", {
            loop: true,
            spaceBetween: 30,
            slidesPerView: 1,
            navigation: {
                nextEl: ".review-button-next",
                prevEl: ".review-button-prev",
            },
            pagination: {
                el: ".review-pagination",
                clickable: true,
            },
            breakpoints: {
                1100: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                }
            }
        });
    }
});
