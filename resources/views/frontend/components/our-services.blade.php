
<!-- Our Services Section -->
@if ($ourservices ->isNotEmpty())
  <section  class=" py-5 bg-white text-center">
  <div class="container py-5" data-aos="fade-up">
    <h2 class="mb-4 text-start">Our Services</h2>
    <hr class="my-4">

    <div id="offerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">

            @foreach ($ourservices->chunk(3) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row justify-content-center gx-4">
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

        <!-- Indicators -->
        <div class="carousel-indicators mt-4">
            @foreach ($ourservices->chunk(3) as $chunk)
                <button type="button"
                        data-bs-target="#offerCarousel"
                        data-bs-slide-to="{{ $loop->index }}"
                        class="{{ $loop->first ? 'active' : '' }}"
                        aria-current="{{ $loop->first ? 'true' : 'false' }}">
                </button>
            @endforeach
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#offerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#offerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<style>
    /* smooth layout */
    .carousel-inner {
        padding: 10px 0;
    }

    /* card styling */
    .card {
        border-radius: 20px;
        transition: all 0.3s ease-in-out;
        background-color: #fff;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    /* indicator dots */
    .carousel-indicators [data-bs-target] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #007bff;
    }

    .carousel-indicators .active {
        background-color: #0056b3;
    }

    .carousel-indicators {
        justify-content: center;
        gap: 8px;
    }

    /* responsive view */
    @media (max-width: 768px) {
        .col-md-4 {
            flex: 0 0 80%;
            max-width: 80%;
        }
    }

    body {
        background-color: #f8f9fa;
    }
</style>

<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


  <hr>
</section>

@endif

