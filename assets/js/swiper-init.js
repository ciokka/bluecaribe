document.addEventListener("DOMContentLoaded", function() {
    var thumbSlider, mainSlider, reviewSlider;

    // Inizializzazione thumb-slider
    var thumbSliderEl = document.querySelector(".thumb-slider");
    if (thumbSliderEl) {
        thumbSlider = new Swiper(thumbSliderEl, {
            spaceBetween: 10,
            slidesPerView: 5, // Mostra 6 thumbs sotto i 600px
            freeMode: true, // Attiva lo scorrimento libero
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            slideToClickedSlide: true,
            breakpoints: {
                600: {
                    slidesPerView: 5, // Imposta 6 thumbs sotto i 600px
                    spaceBetween: 15
                },
                601: {
                    slidesPerView: 6, // Imposta 5 thumbs tra 601px e 1100px
                    spaceBetween: 15
                },
                1101: {
                    slidesPerView: 8, // Mostra 8 thumbs sopra i 1100px
                    spaceBetween: 15
                }
            }
        });
    }

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
            },
            zoom: {
                maxRatio: 2,
                minRatio: 1,
            }
        });
    }

    // Inizializzazione review-slider
    var reviewSliderEl = document.querySelector(".review-slider");
    if (reviewSliderEl) {
        reviewSlider = new Swiper(reviewSliderEl, {
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
