<!-- Top Airlines Section -->
<section class="py-5 bg-light text-center">
  <div class="container">
    <h2 class="mb-4">Top Airlines Are With Us</h2>
    <hr />
    <div class="row justify-content-center g-3">
      @php
    $directions = ['fade-up', 'fade-down', 'fade-left', 'fade-right'];
@endphp
    @foreach ($airlines as $airline)


      <div data-aos="{{ $directions[$loop->index % count($directions)] }}" class="col-6 col-md-2">
        <img
          src="{{ $airline->image_url }}"
          style="height: 100px;  !important;"
          class="img-fluid  cover border rounded p-3"
          alt=""
        />
      </div>
      @endforeach
    </div>
  </div>
</section>
