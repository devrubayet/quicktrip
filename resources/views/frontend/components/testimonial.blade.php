<section class="container py-5 overflow-hidden">
    <h2 class="mb-4 text-center">What Says Our Client</h2>
    <hr class="my-4">

    <div data-aos="fade-right" class="swiper testimonialSwiper">
        <div class="swiper-wrapper">
            @foreach ($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-card p-5 position-relative mx-3">
                        <div class="quote-icon">"</div>
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <img src="{{ $testimonial->image_url }}" class="avatar cover mb-3" alt="User Avatar">
                                <h5 class="mb-1">{{ $testimonial->name }}</h5>
                                <p class="text-muted mb-0">{{ $testimonial->bio }}</p>
                            </div>
                            <div class="col-md-8">
                                <p class="lead mb-0">"{{ $testimonial->message }}"</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination mt-3"></div>
    </div>

    <script>
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
    </script>

    <style>
    .testimonialSwiper {
        overflow: hidden !important;
        width: 100%;
    }

    .testimonialSwiper .swiper-slide {
        display: flex;
        justify-content: center;
    }

    .testimonial-card {
        width: 100%;
        max-width: 900px;
        border: 1px solid #eee;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .quote-icon {
        position: absolute;
        top: 15px;
        left: 25px;
        font-size: 60px;
        color: rgba(0, 0, 0, 0.1);
        font-weight: bold;
    }
</style>

</section>
