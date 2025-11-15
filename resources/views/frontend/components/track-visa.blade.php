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
        ${data.data.pdf ? `<p><strong>Your Visa PDF:</strong> <a href="storage/${data.data.pdf}" target="_blank" class="btn btn-outline-primary btn-sm">Download PDF</a></p>` : '<p><strong>Your Visa PDF:</strong> Not Available</p>'}
    </div>
  </div>
</div>
<script>
  // ajax track
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('visa-status-form');
    const input = document.getElementById('reference_number');
    const clearBtn = document.getElementById('clearInput');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const modalBody = document.getElementById('visaStatusModalBody');
    const visaModal = new bootstrap.Modal(document.getElementById('visaStatusModal'));

    input.addEventListener('input', () => clearBtn.style.display = input.value.length ? 'block' : 'none');
    clearBtn.addEventListener('click', () => { input.value = ''; clearBtn.style.display = 'none'; input.focus(); });

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const referenceNumber = input.value.trim();
        if(!referenceNumber) return;

        // Show modal immediately with loading spinner
        modalBody.innerHTML = `
            <div class="text-center py-3">
                <div class="spinner-border text-secondary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Searching your application...</p>
            </div>
        `;
        visaModal.show();

        fetch("{{ route('visa-find') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ reference_number: referenceNumber })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                modalBody.innerHTML = `
                    <div class="card border-0 shadow-lg p-3">
                        <h5 class="fw-bold text-success mb-3">Application Found ✅</h5>
                        <p><strong>Applicant Name:</strong> ${data.data.applicant_name}</p>
                        <p><strong>Reference Number:</strong> ${data.data.reference_number}</p>
                        <p><strong>Passport Number:</strong> ${data.data.name}</p>
                        <p><strong>Status:</strong> <span class="badge bg-${data.data.status==='Approved'?'success':'warning'}">${data.data.status}</span></p>
                        
                       
                    </div>
                `;
            } else {
                modalBody.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(err => {
            modalBody.innerHTML = `<div class="alert alert-danger">Something went wrong! Please try again later.</div>`;
            console.error(err);
        });
    });
});

</script>


