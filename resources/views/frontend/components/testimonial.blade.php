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

 

</section>
