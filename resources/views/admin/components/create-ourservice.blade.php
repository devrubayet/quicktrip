@extends('admin.base')
@section('title',$site_infos->sitename .' | '.  (isset($slider) ? 'Edit Our Service Slider' : 'Add Our Service Slider' ))
@section('content')


<div class="page-header">
    <h3 class="page-title">{{ isset($slider) ? 'Edit Our Service Slider' : 'Add Our Service Slider' }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Our Service Slider</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ isset($slider) ? 'Edit Slider' : 'Add Slider' }}</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ isset($slider) ? 'Edit Slider' : 'Add Slider' }}</h4>
        <p class="card-description">{{ isset($slider) ? 'Update the service slider' : 'Add new service slider' }}</p>

        <form class="forms-sample"
              action="{{ isset($slider) ? route('services-update', $slider->id) : route('services-store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @if(isset($slider))
                @method('PUT')
            @endif

            {{-- Title --}}
            <div class="form-group">
                <label for="title">Slider Title</label>
                <input type="text" class="form-control" name="title" id="title"
                       placeholder="Slider Title"
                       value="{{ old('title', $slider->title ?? '') }}" required>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label class="form-label d-block mb-2">Status</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="status" name="status"
                           {{ isset($slider) && $slider->status == 'active' ? 'checked' : (!isset($slider) ? 'checked' : '') }}>
                    <label class="form-check-label" for="status">Active</label>
                </div>
            </div>

            {{-- Image Upload --}}
            <div class="form-group">
                <label>Image upload</label>
                <input type="file" name="image" class="file-upload-default">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled
                           placeholder="Upload Image" value="{{ $slider->image ?? '' }}">
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                </div>

                {{-- Existing image preview (edit mode) --}}
                @if(isset($slider) && $slider->image)
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="slider"
                         class="img-fluid mt-2" style="max-height:150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary mr-2">{{ isset($slider) ? 'Update' : 'Submit' }}</button>
            <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
        </form>
    </div>
</div>

<script>
    // file upload UI
    document.querySelector('.file-upload-browse').addEventListener('click', function () {
        document.querySelector('.file-upload-default').click();
    });

    document.querySelector('.file-upload-default').addEventListener('change', function () {
        if (this.files.length > 0) {
            document.querySelector('.file-upload-info').value = this.files[0].name;
        }
    });
</script>
@endsection
