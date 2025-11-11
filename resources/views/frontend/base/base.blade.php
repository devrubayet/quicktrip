<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <title>QuickTripBD</title> --}}
    <title>@yield('title', $site_infos->sitename ?? config('app.name')) </title>
    {{-- SEO Meta --}}
    <meta name="description" content="@yield('meta_description', $site_infos->site_slogan ?? '')">
    <meta name="keywords" content="@yield('meta_keywords', 'travel, visa, airline, services')">

    {{-- Open Graph for Facebook/LinkedIn --}}
    <meta property="og:title" content="@yield('title', $site_infos->sitename ?? config('app.name'))">
    <meta property="og:description" content="@yield('meta_description', $site_infos->site_slogan ?? '')">
    <meta property="og:image" content="{{ asset('frontend/img/bg-banner1.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="author" content="QuickTrip Team" />
    <meta name="robots" content="index, follow" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('admin-end/assets/favicon_io/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin-end/assets/favicon_io/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin-end/assets/favicon_io/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('admin-end/assets/favicon_io/site.webmanifest') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Moment.js -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<!-- Daterangepicker CSS + JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />


</head>

<body>
    <!-- Spinner -->
    {{-- <div id="preloader" class="d-flex d-none justify-content-center align-items-center"
        style="position: fixed; top:0; left:0; width:100%; height:100%;
                background:#fff; z-index:9999;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> --}}

    


    <!-- navbar -->
    <!-- Navbar -->
    <nav class="navbar bg-body-tertiary text-uppercase sticky-top text-light navbar-expand-lg py-0">
        <div class="container">
            <!-- Logo Section -->
            <a data-aos="fade-left" class="navbar-brand" href="{{ route('home') }}">
                @if ($site_infos && $site_infos->logo)
                    <img class="img-fluid" src="{{ asset('storage/' . $site_infos->logo) }}"
                        alt="{{ $site_infos->sitename }}" />
                @else
                    <img class="img-fluid" src="{{ asset('default-logo.png') ?? '' }}"
                        alt="{{ $site_infos->sitename }}" />
                @endif
            </a>

            <!-- Navbar Toggle Button for Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse justify-content-end py-0 text-light" id="navbarNav">
                <ul data-aos="fade-right" data-aos-delay="103ms" class="navbar-nav text-light">
                    <li class="nav-item">
                        <a class="menu-item nav-link" href=" {{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link menu-item dropdown-toggle" href="#" id="dropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Visa
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                            <li>
                                <a class="dropdown-item" href="#">visa name</a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link menu-item dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Package
                        </a>
                        <ul class="dropdown-menu text-light" aria-labelledby="dropdownMenuLink">
                            {{-- {% for package in package_list %} --}}
                            <li>
                                <a class="dropdown-item" href="#"></a>
                            </li>
                            {{-- {% endfor %} --}}
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="menu-item nav-link" href="{{ route('contact-us') }}">Contact Us</a>
                    </li>
                    @if ($banks->isNotEmpty())
                        <li class="nav-item px-2">
                        <button type="button" class="btn btn-blue rounded-5 px-4 fw-bold py-2" data-bs-toggle="modal"
                            data-bs-target="#bankDetailsModal">
                            Bank Details
                        </button>


                    </li>
                    @endif
                    
                </ul>
            </div>
        </div>

    </nav>

   

    <main class="container-fluid p-0">
        
 <!-- Modal -->
    <div class="modal fade" id="bankDetailsModal" tabindex="-1" aria-labelledby="bankDetailsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-dark-blue">
                    <h2 class="modal-title w-100 bg-dark-blue text-light text-center" id="bankDetailsLabel">
                        Bank Details->
                    </h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-dark-blue text-light">
                                <tr>
                                    <th>Bank Name</th>
                                    <th>Account Name</th>
                                    <th>Account No.</th>
                                    <th>Branch Name</th>
                                    <th>Swift Code</th>
                                    <th>Routing No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-danger', 'bg-info'];
                                @endphp
                                @foreach ($banks as $bank)
                                    @php
                                        $randomColor = $colors[array_rand($colors)];
                                    @endphp
                                    <tr>
                                        <td class="{{ $randomColor }} text-light fw-bold">
                                            {{ $bank->bank_name }}
                                        </td>
                                        <td>{{ $bank->account_name }}</td>
                                        <td>{{ $bank->account_number }}</td>
                                        <td>{{ $bank->branch_name }}</td>
                                        <td>{{ $bank->swift_code ? $bank->swift_code : 'N/A' }}
                                        </td>
                                        <td>{{ $bank->routing_number ? $bank->routing_number : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="footer-info bg-dark-blue mt-4 text-dark">
                        <p>
                            📧 support@quicktripbd.com | 📞 +880 9611 678 508 |
                            🌐 www.quicktripbd.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Default content -->
        @yield('content')

    </main>

    <!-- Tracking -->


    <!-- Footer Section -->
    @include('frontend.components.footer')


    <!-- Bootstrap Icons -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
    <script>
        // window.addEventListener("load", function() {
        //     const preloader = document.getElementById("preloader");

        //     // Fade out smoothly
        //     preloader.style.transition = "opacity 0.5s ease, visibility 0.5s ease";
        //     preloader.style.opacity = "0";
        //     preloader.style.visibility = "hidden";

        //     // Fully remove after animation
        //     setTimeout(() => {
        //         preloader.remove(); // পুরো DOM থেকে মুছে ফেলবে
        //     }, 0.1);
        // });


        document.addEventListener("DOMContentLoaded", function() {
            const dropdowns = document.querySelectorAll(".dropdown");

            dropdowns.forEach((dropdown) => {
                dropdown.addEventListener("mouseenter", function() {
                    this.classList.add("show");
                    this.querySelector(".dropdown-menu").classList.add("show");
                });

                dropdown.addEventListener("mouseleave", function() {
                    this.classList.remove("show");
                    this.querySelector(".dropdown-menu").classList.remove("show");
                });
            });
        });
    </script>


</body>

</html>
