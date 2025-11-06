
<!-- Our Services Section -->
@if ($ourservices ->isNotEmpty())
  <section  class=" py-5 bg-white text-center">
  <div data-aos="fade-up" data-aos-delay="0.5ms" class="container my-5">
  <h2 class="mb-4 text-start">Our Services</h2>
  <hr class="my-4">

  <div id="multiCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
    <div class="carousel-inner">
      @foreach ($ourservices as $service_slide)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        <div class="col-md-4 col-sm-6">
          <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <img src="{{ $service_slide->image_url }}" 
                 class="card-img-top img-fluid" 
                 alt="Service Image"
                 style="height:220px; object-fit:cover;">
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Prev/Next Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#multiCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#multiCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

<style>
  
</style>


<script>
  // Fix for showing multiple slides at once
  const multipleItemCarousel = document.querySelector('#multiCarousel');
  if (window.matchMedia("(min-width: 768px)").matches) {
    const carousel = new bootstrap.Carousel(multipleItemCarousel, {
      interval: 3000,
      ride: "carousel"
    });

    const carouselInner = multipleItemCarousel.querySelector('.carousel-inner');
    const carouselItems = multipleItemCarousel.querySelectorAll('.carousel-item');

    carouselItems.forEach((el) => {
      const next = el.nextElementSibling || carouselItems[0];
      el.appendChild(next.firstElementChild.cloneNode(true));
    });
  }
</script>

  <hr>
</section>

@endif

