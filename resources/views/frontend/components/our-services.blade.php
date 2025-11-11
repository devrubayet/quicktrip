@if ($ourservices->isNotEmpty())
<section class="py-5 bg-white text-center overflow-hidden">
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
                        class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <img src="{{ $service_slide->image_url }}" class="card-img-top" alt="Service Image"
                            style="height: 220px; object-fit: cover;" />
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination mt-3"></div>
        </div>
    </div>

    
</section>
@endif
