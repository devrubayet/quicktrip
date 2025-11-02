<section class="container py-5">
    <h2 class="mb-4 text-center">What Says Our Client</h2>
    <hr class="my-4">
    <div data-aos="fade-right"
      id="testimonialCarousel"  class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner py-4">
            @foreach ($testimonials as $testimonial)


            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
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

        <div class="carousel-indicators position-relative mt-4">

            <button type="button" class="custom-indicator  forloop first active"
                data-bs-target="#testimonialCarousel"
                data-bs-slide-to=" forloop counter0 "
                aria-current=" forloop firsttrue "
                aria-label="Slide forloop counter ">
            </button>

        </div>
    </div>
</section>
