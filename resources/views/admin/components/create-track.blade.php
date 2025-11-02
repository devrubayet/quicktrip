@extends('admin.base')
@section('title',$site_infos->sitename .' | '. (isset($visa_status) ? 'Edit Visa Status' : 'Add Visa Status'))
@section('content')
<div class="page-header">
    <h3 class="page-title">{{ isset($visa_status) ? 'Edit Visa Status' : 'Add Visa Status' }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ isset($visa_status) ? 'Edit Visa Status' : 'Add Visa Status' }}
            </li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ isset($visa_status) ? 'Edit Visa Information' : 'Add Visa Information' }}</h4>
        <p class="card-description">
            {{ isset($visa_status) ? 'Update the visa status information' : 'Add a new visa status record' }}
        </p>

        {{-- ✅ Form Start --}}
        <form class="forms-sample"
              action="{{ isset($visa_status) ? route('visa-update', $visa_status->id) : route('visa-store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @if(isset($visa_status))
                @method('PUT')
            @endif

            {{-- Applicant Name --}}
            <div class="form-group">
                <label for="applicant_name">Applicant Name</label>
                <input type="text" class="form-control" name="applicant_name" id="applicant_name"
                       placeholder="Applicant Name"
                       value="{{ old('applicant_name', $visa_status->applicant_name ?? '') }}" required>
            </div>

            {{-- Visa Name --}}
            <div class="form-group">
                <label for="name">Visa Name</label>
                <input type="text" class="form-control" name="name" id="name"
                       placeholder="Visa Name"
                       value="{{ old('name', $visa_status->name ?? '') }}" required>
            </div>

            {{-- Reference Number --}}
            <div class="form-group">
                <label for="reference_number">Reference Number</label>
                <input type="text" class="form-control" name="reference_number" id="reference_number"
                       placeholder="Reference Number"
                       value="{{ old('reference_number', $visa_status->reference_number ?? '') }}" required>
            </div>

            {{-- Status --}}
            <div class="form-group">
                <label for="exampleSelectStatus">Status</label>
                <select name="status" class="form-control" id="exampleSelectStatus" required>
                    <option value="Approved" {{ old('status', $visa_status->status ?? '') == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Pending" {{ old('status', $visa_status->status ?? '') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Rejected" {{ old('status', $visa_status->status ?? '') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            {{-- PDF Upload --}}
            <div class="form-group">
                <label>PDF Upload</label>
                <input type="file" name="pdf" class="file-upload-default" accept=".pdf">
                <div class="input-group col-xs-12">
                    <input type="text" class="form-control file-upload-info" disabled
                           placeholder="Upload PDF"
                           value="{{ isset($visa_status) && $visa_status->pdf ? basename($visa_status->pdf) : '' }}">
                    <span class="input-group-append">
                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                    </span>
                </div>

                {{-- Existing PDF (edit mode) --}}
                @if(isset($visa_status) && $visa_status->pdf)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $visa_status->pdf) }}" target="_blank" class="btn btn-info btn-sm">
                            View Existing PDF
                        </a>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary mr-2">{{ isset($visa_status) ? 'Update' : 'Submit' }}</button>
            <a href="{{ url()->previous() }}" class="btn btn-dark">Cancel</a>
        </form>
        {{-- ✅ Form End --}}
    </div>
</div>

{{-- File Upload Script --}}
<script>
    const fileInput = document.querySelector('.file-upload-default');
    const browseBtn = document.querySelector('.file-upload-browse');
    const fileInfo = document.querySelector('.file-upload-info');

    browseBtn.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            fileInfo.value = fileInput.files[0].name;
        }
    });
</script>
@endsection
