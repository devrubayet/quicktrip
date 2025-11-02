@extends('admin.base')
@section('title',$site_infos->sitename .' | '. 'Site Settings')
@section('content')
<div class="page-header">
    <h3 class="page-title">Site Settings</h3>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('settings-update', $settings->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="sitename">Site Name</label>
                <input type="text" name="sitename" class="form-control" value="{{ old('sitename', $settings->sitename) }}" required>
            </div>

            <div class="form-group">
                <label for="site_slogan">Site Slogan</label>
                <input type="text" name="site_slogan" class="form-control" value="{{ old('site_slogan', $settings->site_slogan) }}">
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" name="logo" class="form-control-file">
                @if($settings->logo)
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo" style="max-height:100px;margin-top:10px;">
                @endif
            </div>

            <div class="form-group">
                <label for="about_us">About Us</label>
                <textarea name="about_us" class="form-control" rows="3">{{ old('about_us', $settings->about_us) }}</textarea>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $settings->phone) }}">
            </div>

            <div class="form-group">
                <label for="office_phone">Office Phone</label>
                <input type="text" name="office_phone" class="form-control" value="{{ old('office_phone', $settings->office_phone) }}">
            </div>

            <div class="form-group">
                <label for="office_mail">Office Mail</label>
                <input type="email" name="office_mail" class="form-control" value="{{ old('office_mail', $settings->office_mail) }}">
            </div>

            <div class="form-group">
                <label for="notice">Notice</label>
                <textarea name="notice" class="form-control" rows="2">{{ old('notice', $settings->notice) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Settings</button>
        </form>
    </div>
</div>
@endsection
