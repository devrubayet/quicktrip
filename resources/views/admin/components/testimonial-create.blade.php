@extends('admin.base')
@section('title',$site_infos->sitename .' | '. $site_infos->site_slogan)
@section('content')
<div class="page-header">
        <h3 class="page-title">Add Feedback </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">FeedBack</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Feedback</li>
            </ol>
        </nav>
    </div>
    <div class="container mx-auto col-md-6 p-5">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div>
            <div class="form-group p-3">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" class="form-control-file" id="exampleFormControlFile1">
            </div>
            <div class="form-group py-3">
                <label for="bio">Bio</label>
                <input type="text" class="form-control" id="bio" name="bio" placeholder="Enter bio">
            </div>
            <div class="form-group py-3">
                <label for="msg">Message</label>
                <textarea type="text" class="form-control" id="msg" name="message" rows="4" placeholder="Enter Message">

                </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
