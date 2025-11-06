<section class="container py-5">
    <h2 class="mb-4 text-center">What Says Our Client</h2>
    <hr class="my-4">
    <div data-aos="fade-right" class="swiper-container">
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

    <!-- Optional: Add Pagination (dots) -->
    <div class="swiper-pagination"></div>

  
</div>

<script>
    var swiper = new Swiper('.swiper-container', {
    loop: true, // Make it loop continuously
    autoplay: {
        delay: 5000, // 5 seconds for auto sliding
    },
    slidesPerView: 1, // Number of slides visible at once
    slidesPerGroup: 1,
    spaceBetween: 30, // Space between slides
    pagination: {
        el: '.swiper-pagination', // Dots for pagination
        clickable: true,
    },
    
});

</script>
</section>
