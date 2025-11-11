<!-- Our Services Section -->
@if ($ourservices->isNotEmpty())
<section class="py-5 bg-white text-center">
  <div data-aos="fade-up" data-aos-delay="0.5ms" class="container py-5">
    <h2 class="mb-4 text-start">Exclusive Offers</h2>
    <hr class="my-4" />

    <!-- Swiper -->
    <div class="swiper mySwiper">
      @php
        $directions = ['fade-up', 'fade-down', 'fade-left', 'fade-right'];
      @endphp
      <div class="swiper-wrapper">
        @foreach ($ourservices as $service_slide)
        <div class="swiper-slide">
          <div data-aos="{{ $directions[$loop->index % count($directions)] }}" 
               class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            <img
              src="{{ $service_slide->image_url }}"
              class="card-img-top"
              alt="Service Image"
              style="height: 220px; object-fit: cover;"
            />
          </div>
        </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="swiper-pagination mt-3"></div>
    </div>
  </div>
</section>

<!-- Swiper Init -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    slidesPerGroup: 1,
    spaceBetween: 20,
    loop: true,
    centeredSlides: false, // ❌ disable this to fix the right gap
    autoplay: {
      delay: 2000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      0: { slidesPerView: 1, spaceBetween: 10 },
      768: { slidesPerView: 2, spaceBetween: 15 },
      992: { slidesPerView: 3, spaceBetween: 20 },
    },
  });
</script>

<style>
/* Swiper Fix CSS */
.mySwiper {
  overflow: hidden !important;
  width: 100%;
}

.swiper-wrapper {
  overflow: hidden !important;
  display: flex;
}

.swiper-slide {
  flex-shrink: 0;
  width: auto;
}

.card img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}
</style>
@endif
