<style>
    .card-bg{
            background: linear-gradient(90deg, #04004714 0%, #ffffff17 30%, #aeb6ff17 100%);

    }
</style>
<!-- Our Services Section -->
@if ($ourservices ->isNotEmpty())
  <section  class=" py-5 bg-white text-center">
  <div data-aos="fade-up" data-aos-delay="0.5ms" class="container">
    <h2 class="mb-4">Our Services</h2>
    <hr class="my-4">

        <div
          id="carouselExampleSlidesOnly"
          class="carousel slide "
          data-bs-ride="carousel"
          data-bs-interval="3000"
        >
          <div class="carousel-inner">
            @foreach ( $ourservices as $service_slide )


            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
              <img src="{{ $service_slide->image_url }}" class="w-100 d-block" alt="..." />
            </div>
             @endforeach
          </div>
        </div>

  </div>
  <hr>
</section>

@endif

