@extends('base.base')

@section("content")
<div class="container mx-auto col-md-6 p-5">
    <form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title"  placeholder="Enter title">

  <div class="form-group p-3">

    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" ">
  </div>
   <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection
