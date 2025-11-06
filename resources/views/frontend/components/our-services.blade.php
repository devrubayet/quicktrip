
<!-- Our Services Section -->
@if ($ourservices ->isNotEmpty())
  <section  class=" py-5 bg-white text-center">
  <div data-aos="fade-up" data-aos-delay="0.5ms" class="container my-5">
    <h2 class="mb-4 text-start">Our Services</h2>
    <hr class="my-4">

    <div id="multiCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">

            @foreach ($ourservices->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row justify-content-center g-3">
                        @foreach ($chunk as $service_slide)
                            <div class="col-md-4 col-sm-6">
                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                    <img src="{{ $service_slide->image_url }}" 
                                         class="card-img-top img-fluid" 
                                         alt="Service Image"
                                         style="height:220px; object-fit:cover;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Carousel Indicators -->
        <div class="carousel-indicators position-static mt-4">
            @foreach ($ourservices->chunk(3) as $chunk)
                <button type="button"
                        data-bs-target="#multiCarousel"
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

