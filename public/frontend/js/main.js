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


// testimonial
var swiper = new Swiper('.testimonialSwiper', {
            slidesPerView: 1,
            slidesPerGroup: 1,
            spaceBetween: 30,
            loop: true,
            centeredSlides: false, // ❌ prevent unwanted spacing when looping
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                },
                992: {
                    slidesPerView: 1,
                }
            }
        });





        // our service
         var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            slidesPerGroup: 1,
            spaceBetween: 20,
            loop: true,
            centeredSlides: false, // ❌ center korle overflow dekhay — eta off
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
            },
        });


        // clear button 
        document.addEventListener("DOMContentLoaded", function() {
            const dropdowns = document.querySelectorAll(".dropdown");

            dropdowns.forEach((dropdown) => {
                dropdown.addEventListener("mouseenter", function() {
                    this.classList.add("show");
                    this.querySelector(".dropdown-menu").classList.add("show");
                });

                dropdown.addEventListener("mouseleave", function() {
                    this.classList.remove("show");
                    this.querySelector(".dropdown-menu").classList.remove("show");
                });
            });
        });