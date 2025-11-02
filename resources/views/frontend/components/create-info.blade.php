@extends('base.base')
@section('title','Create Info' .'|'. $site_infos->sitename)
@section('meta_description', $site_infos->sitename.'is'. $site_infos->about_us.'.Explore the world with QuickTrip – trusted travel agency for visas, tours & unbeatable deals.')
@section('meta_keywords', 'home, visa, travel, airlines')

@section('content')
    <div class="container mx-auto col-md-6 p-5">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sitename">Site name</label>
                <input type="text" class="form-control" id="sitename" name="sitename" placeholder="Enter Name">
            </div>

            <div class="form-group p-3">
                <label for="logo">Logo</label>
                <input type="file" name="logo" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group">
                <label for="site_slogan">Site slogan</label>
                <input type="text" class="form-control" id="site_slogan" name="site_slogan" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="about_us">about_us</label>
                <input type="text" class="form-control" id="about_us" name="about_us" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="phone">phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="office_phone">office_phone</label>
                <input type="text" class="form-control" id="office_phone" name="office_phone" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="office_mail">office_mail</label>
                <input type="text" class="form-control" id="office_mail" name="office_mail" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="notice">notice</label>
                <input type="text" class="form-control" id="notice" name="notice" placeholder="Enter Name">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
