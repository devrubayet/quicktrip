<footer class="footer">
    <div class="container">
        <div class="row d-flex justify-content-around">
            <!-- Popular Services -->

            <!-- Get in Touch -->
            <div class="col-md-6 " data-aos="fade-right"
     >
                <h5>Get in Touch</h5>
                <p>
                    <strong><i class="bi bi-building"></i> {{ $site_infos->sitename ?? "" }}</strong>
                </p>
                <p>{{ $site_infos->site_slogan ?? '' }}</p>
                <p><i class="bi bi-geo-alt pe-2"></i>{{ $site_infos->address ?? '' }}</p>
                <p><i class="bi bi-telephone pe-2"></i>{{ $site_infos->office_phone ?? '' }} </p>
                <p><i class="bi bi-envelope pe-2"></i>{{ $site_infos->office_mail ?? '' }}</p>
            </div>
            <!-- About Us -->
            <div class="col-md-6" data-aos="fade-left"
     >
                <h5>About Us</h5>
                <p>{{ $site_infos->about_us ?? ' ' }}</p>

                <div class="container py-5">
                    <h5 class="text-white mb-4">Payment Methods</h5>
                    <div class="payment row text-center justify-content-center gap-2 align-items-center">
                        <div class="col-4 col-sm-3 col-md-2 bg-light border rounded mb-3">
                            <img src="{{ asset('frontend/img/American-Express-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 bg-light border rounded mb-3">
                            <img src="{{ asset('frontend/img/BKash-Horizontal-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 bg-light border rounded mb-3">
                            <img src="{{ asset('frontend/img/Master-Card-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 bg-light border rounded mb-3">
                            <img src="{{ asset('frontend/img/Nagad-Horizontal-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 bg-light border rounded mb-3">
                            <img src="{{ asset('frontend/img/Visa-Card-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 bg-light border rounded mb-3">
                            <img src="{{ asset('frontend/img/sslcommerce.png') }}" class="img-fluid" alt="Visa" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Newsletter -->
        </div>
    </div>
    <!-- Footer Bottom -->
    <div class="footer-bottom py-4 fs-6">
        © Copyright QuickTripbd.com 2025 |
Powerd By SintecIT Ltd. Devloped by Rubayet Hossain
    </div>
</footer>
