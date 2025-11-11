   <footer class="footer  pt-5">
  <div class="container">
    <div class="row justify-content-between gy-4">
      <!-- Get in Touch -->
      <div class="col-md-6" data-aos="fade-right">
        <h5 class="text-white">Get in Touch</h5>
        <p><strong><i class="bi bi-building"></i> {{ $site_infos->sitename ?? "" }}</strong></p>
        <p>{{ $site_infos->site_slogan ?? '' }}</p>
        <p><i class="bi bi-geo-alt pe-2"></i>{{ $site_infos->address ?? '' }}</p>
        <p><i class="bi bi-telephone pe-2"></i>{{ $site_infos->office_phone ?? '' }}</p>
        <p><i class="bi bi-envelope pe-2"></i>{{ $site_infos->office_mail ?? '' }}</p>
      </div>

      <!-- About Us + Payment -->
      <div class="col-md-6" data-aos="fade-left">
        <h5 class="text-white">About Us</h5>
        <p>{{ $site_infos->about_us ?? ' ' }}</p>

        <h6 class="text-white mt-4 mb-3">Payment Methods</h6>
        
                   
                    <div class="payment row text-center justify-content-center gap-2 align-items-center">
                        <div data-aos="fade-left" class="col-4 col-sm-3 col-md-2 bg-light border rounded ">
                            <img src="{{ asset('frontend/img/American-Express-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div data-aos="fade-right" class="col-4 col-sm-3 col-md-2 bg-light border rounded ">
                            <img src="{{ asset('frontend/img/BKash-Horizontal-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div data-aos="fade-down" class="col-4 col-sm-3 col-md-2 bg-light border rounded ">
                            <img src="{{ asset('frontend/img/Master-Card-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div data-aos="fade-up" class="col-4 col-sm-3 col-md-2 bg-light border rounded ">
                            <img src="{{ asset('frontend/img/Nagad-Horizontal-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div data-aos="fade-left" class="col-4 col-sm-3 col-md-2 bg-light border rounded ">
                            <img src="{{ asset('frontend/img/Visa-Card-Logo.svg') }}" class="img-fluid" alt="Visa" />
                        </div>
                        <div data-aos="fade-up" class="col-4 col-sm-3 col-md-2 bg-light border rounded">
                            <img src="{{ asset('frontend/img/sslcommerce.png') }}" class="img-fluid" alt="Visa" />
                        </div>
                    </div>
             
        
      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom text-center text-white py-3 mt-4 border-top" style="font-size: 0.9rem;">
    © Copyright QuickTripbd.com 2025 | Powered By SintecIT Ltd. Developed by Rubayet Hossain
  </div>
</footer>

<style>

</style>