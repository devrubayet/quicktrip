@extends('frontend.base.base')
@section('title',$site_infos->sitename .' | '. $site_infos->site_slogan)
@section('meta_description', $site_infos->sitename.'is'. $site_infos->about_us.'.Explore the world with QuickTrip – trusted travel agency for visas, tours & unbeatable deals.')
@section('meta_keywords', 'home, visa, travel, airlines')

@section('content')






<section   class="banner py-5 ">

    <h2 class="mx-auto text-light px-5">Track & Retrieve your Passport</h2>
    <hr class="container-fluid">


    <div class="container  py-5 ">

            <div class="track  col-12 h-100 my-5  d-flex justify-content-center">
                <div class="box col-md-6">

                   

                    @include('frontend.components.track-visa')

                </div>
            </div>








    </div>


  </section>




  @include('frontend.components.our-services')

  @include('frontend.components.booking')

  @include("frontend.components.testimonial")


  @include("frontend.components.airlines")


@endsection
