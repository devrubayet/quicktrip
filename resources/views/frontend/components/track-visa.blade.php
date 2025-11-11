<!-- Visa Tracking Card -->
<div class="card shadow-lg p-4 rounded-3" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
    <p class="fs-5 fw-bold mb-3 text-secondary">
        Enter your reference number to track your application
    </p>

    <form id="visa-status-form" class="row g-2">
        @csrf
        <div class="col-12 col-md-8 position-relative">
            <input type="text" name="reference_number" class="form-control form-control-lg pe-5" id="reference_number" placeholder="Enter Reference Number" required>
            <span id="clearInput" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor:pointer; display:none; font-size:18px; color:#999;">&times;</span>
        </div>
        <div class="col-12 col-md-auto">
            <button type="submit" class="btn btn-secondary btn-lg w-100">Track</button>
        </div>
    </form>
</div>

<div class="modal fade" id="visaStatusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-3">
      <div class="modal-header">
        <h5 class="modal-title">Visa Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="visaStatusModalBody" style="max-height:70vh; overflow-y:auto;">
        <!-- AJAX result goes here -->
      </div>
      {{--   ${data.data.pdf ? `<p><strong>Your Visa PDF:</strong> <a href="storage/${data.data.pdf}" target="_blank" class="btn btn-outline-primary btn-sm">Download PDF</a></p>` : '<p><strong>Your Visa PDF:</strong> Not Available</p>'} --}}
    </div>
  </div>
</div>



