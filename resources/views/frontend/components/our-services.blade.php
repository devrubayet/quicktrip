<style>
    .card-bg{
            background: linear-gradient(90deg, #04004714 0%, #ffffff17 30%, #aeb6ff17 100%);

    }
</style>
<!-- Our Services Section -->
@if ($ourservices ->isNotEmpty())
  <section  class=" py-5 bg-white text-center">
  <div data-aos="fade-up" data-aos-delay="0.5ms" class="container my-5">
    <h2 class="mb-4 text-start">Our Services</h2>
    <hr class="my-4">

    <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner text-center">
            @foreach ($ourservices as $service_slide)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        <img src="{{ $service_slide->image_url }}" 
                             class="img-fluid rounded-4 shadow-sm service-slide"
                             alt="Service Image">
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Carousel Indicators (small dots) -->
        <div class="carousel-indicators position-static mt-4">
            @foreach ($ourservices as $service_slide)
                <button type="button"
                        data-bs-target="#serviceCarousel"
                        data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"
                        aria-current="{{ $loop->first ? 'true' : 'false' }}">
                </button>
            @endforeach
        </div>
    </div>
</div>
  <hr>
</section>

@endif

