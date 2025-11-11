

// testimonial
var swiper = new Swiper('.testimonialSwiper', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 30,
            loop: true,
            centeredSlides: false, // ❌ prevent unwanted spacing when looping
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
                992: {
                    slidesPerView: 1,
                }
            }
        });





        // our service
         var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 20,
            loop: true,
            centeredSlides: false, // ❌ center korle overflow dekhay — eta off
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
            },
        });


        // clear button 
        document.addEventListener("DOMContentLoaded", function() {
            const dropdowns = document.querySelectorAll(".dropdown");

            dropdowns.forEach((dropdown) => {
                dropdown.addEventListener("mouseenter", function() {
                    this.classList.add("show");
                    this.querySelector(".dropdown-menu").classList.add("show");
                });

                dropdown.addEventListener("mouseleave", function() {
                    this.classList.remove("show");
                    this.querySelector(".dropdown-menu").classList.remove("show");
                });
            });
        });