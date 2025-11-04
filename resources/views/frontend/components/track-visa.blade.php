<div class="card shadow-sm p-4 rounded-3" data-aos="fade-up"
     data-aos-anchor-placement="top-bottom">
    <p class="fs-5 fw-bold mb-3 text-secondary">
        Enter your reference number to track your application
    </p>

    <!-- Track Form -->
    <form action="{{ route('visa-find') }}" id="visa-status-form" class="row g-2" method="post">
        @csrf
        <div class="col-12 col-md-8 position-relative">
            <input type="text"
                   name="reference_number"
                   class="form-control form-control-lg pe-5"
                   id="reference_number"
                   placeholder="Enter Reference Number"
                   required>

            <!-- Clear Button -->
            <span id="clearInput"
                  style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor:pointer; display:none; font-size:18px; color:#999;">
                &times;
            </span>
        </div>
        <div class="col-12 col-md-auto">
            <button type="submit" class="btn btn-secondary btn-lg w-100">Track</button>
        </div>
    </form>

    <!-- Result Section -->
    <div id="visa-status-result" class="mt-4"></div>
</div>


<script>
    const form = document.getElementById('visa-status-form');
    const input = document.getElementById('reference_number');
    const clearBtn = document.getElementById('clearInput');
    const resultDiv = document.getElementById('visa-status-result');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Clear button show/hide
    input.addEventListener('input', () => {
        clearBtn.style.display = input.value.length ? 'block' : 'none';
    });

    // Clear input on click
    clearBtn.addEventListener('click', () => {
        input.value = '';
        clearBtn.style.display = 'none';
        input.focus();
    });

    // Handle form submit
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const referenceNumber = input.value;

        resultDiv.innerHTML = `
            <div class="text-center py-3">
                <div class="spinner-border text-secondary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Searching your application...</p>
            </div>
        `;

        fetch("{{ route('visa-find') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                "Accept": "application/json",
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ reference_number: referenceNumber })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                resultDiv.innerHTML = `
                    <div class="card border-0 shadow-sm p-3 mt-3">
                        <h5 class="fw-bold text-success mb-3">Application Found ✅</h5>
                        <p><strong>Reference Number:</strong> ${data.data.reference_number}</p>
                        
                        <p><strong>Status:</strong>
                            <span class="badge bg-${data.data.status === 'Approved' ? 'success' : 'warning'}">
                                ${data.data.status}
                            </span>
                        </p>
                        <p><strong>Applicant Name:</strong> ${data.data.applicant_name}</p>
                        ${
                            data.data.pdf
                            ? `<p><strong>Your Visa PDF:</strong>
                                   <a class="btn btn-outline-primary btn-sm" href="storage/${data.data.pdf}" target="_blank">Download PDF</a>
                               </p>`
                            : '<p><strong>Your Visa PDF:</strong> Not Available</p>'
                        }
                    </div>
                `;
            } else {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger mt-3" role="alert">
                        ${data.message}
                    </div>
                `;
            }
        })
        .catch(error => {
            resultDiv.innerHTML = `
                <div class="alert alert-danger mt-3" role="alert">
                    Something went wrong! Please try again later.
                </div>
            `;
            console.error('Error:', error.message);
        });
    });
</script>
