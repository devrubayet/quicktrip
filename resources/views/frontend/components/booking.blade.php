<style>
    /* ===== Tabs ===== */
    .booking-tabs {
        background: #fff;
        border-radius: 12px;
        display: inline-block;
        padding: 6px 10px;
        position: relative;
        z-index: 2;
        /* keep it above the box */
    }

    .booking-tabs .nav-link {
        border: none;
        color: #333;
        font-weight: 600;
        padding: 10px 28px;
        position: relative;
    }

    .booking-tabs .nav-link.active {
        color: #002366;
    }

    .booking-tabs .nav-link.active::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 25%;
        width: 50%;
        height: 3px;
        background: #ffd000;
        border-radius: 3px;
    }

    /* ===== Search Box ===== */
    .search-box {
        background: #fff;
        border-radius: 20px;
        padding: 35px 40px 80px;
        /* extra bottom space for overlapping button */
        max-width: 1150px;
        position: relative;
        margin: -35px auto 0;
        /* pull up so tab overlaps and center horizontally */
        z-index: 1;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }

    .search-box .form-control {
        border: none;
        border-bottom: 1px solid #ddd;
        border-radius: 0;
        font-size: 18px;
        font-weight: 600;
        box-shadow: none !important;
    }

    .search-box label {
        font-weight: 600;
        font-size: 14px;
        color: #555;
    }

    .search-box small {
        display: block;
        font-size: 13px;
        color: #999;
        margin-top: 3px;
    }

    /* ===== Overlapping Search Button ===== */
    .search-btn {
        position: absolute !important;
        width: auto !important;
        /* prevent full width */
        left: 50%;
        bottom: -30px;
        /* overlap outside the box */
        transform: translateX(-50%);
        background: #ffd000;
        color: #002366;
        font-weight: 700;
        border: none;
        border-radius: 12px;
        padding: 16px 55px;
        font-size: 18px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: #f5c600;
        transform: translateX(-50%) translateY(-2px);
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .booking-tabs .nav-link {
            padding: 8px 14px;
            font-size: 14px;
        }

        .search-box {
            padding: 25px 20px 70px;
        }

        .search-box .form-control {
            font-size: 16px;
        }

        .search-btn {
            padding: 14px 35px;
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .booking-tabs {
            padding: 4px 6px;
        }

        .booking-tabs .nav-link {
            padding: 6px 10px;
            font-size: 13px;
        }

        .search-box {
            padding: 20px 15px 65px;
        }

        .search-box .form-control {
            font-size: 15px;
        }
    }
</style>


<section class="container-fluid text-center py-5 position-relative  bg-light">


    <div class="container py-5 mx-auto booking d-flex flex-column align-items-center">
        <h2 class="mb-4 text-bold text-light">Book Your Reservation</h2>
    <hr class="my-4">
        <div data-aos="fade-up" data-aos-delay="0.5ms" class="">
            <!-- Tabs (on top, overlapping) -->
            <div data-aos="fade-up" data-aos-delay="0.5ms" class="booking-tabs shadow">
                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#flight">
                            <i class="bi bi-airplane"></i> Flight
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#hotel">
                            <i class="bi bi-building"></i> Hotel
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tour">
                            <i class="bi bi-tree"></i> Tour
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#visa">
                            <i class="bi bi-passport"></i> Visa
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Content Box -->
            <div class="tab-content w-100">
                <div class="tab-pane fade show active" id="flight">
                    <form class="search-box row g-4">
                        <!-- Trip Type -->
                        <div class="col-12 text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="oneWay" checked>
                                <label class="form-check-label" for="oneWay">One Way</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="roundWay">
                                <label class="form-check-label" for="roundWay">Round Way</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="multiCity">
                                <label class="form-check-label" for="multiCity">Multi City</label>
                            </div>
                        </div>

                        <!-- From & To -->
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">From</label>
                            <input type="text" class="form-control" value="Dhaka" readonly>
                            <small>DAC, Hazrat Shahjalal International Ai...</small>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">To</label>
                            <input type="text" class="form-control" list="datalistOptions" placeholder="Cox's Bazar">
                            <datalist id="datalistOptions">
                                <option value="San Francisco">
                                <option value="New York">
                                <option value="Seattle">
                                <option value="Los Angeles">
                                <option value="Chicago">
                            </datalist>
                            <small>CXB, Cox's Bazar Airport</small>
                        </div>

                        <!-- Dates -->
                        <div class="col-md-2 col-sm-6">
                            <label for="depature" class="form-label">Departure Date</label>
                            <input type="text" id="depature" class="form-control" value="">
                            <small>Sunday</small>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label for="return" class="form-label">Return Date</label>
                            <input type="text" id="return" class="form-control"
                                placeholder="Save more on return flight">
                        </div>

                        <!-- Traveler -->
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Traveler, Class</label>
                            <input type="text" class="form-control" value="1 Traveler" readonly>
                            <small>Economy</small>
                        </div>

                        <!-- Overlapping Button (must NOT be inside a Bootstrap column) -->
                        <button type="submit" class="search-btn">Search</button>
                    </form>
                </div>


                <!-- Other Tabs -->
                <div class="tab-pane fade " id="hotel">
                    <form class="search-box row g-4">
                        <!-- Trip Type -->
                        <div class="col-12 text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="oneWay" checked>
                                <label class="form-check-label" for="oneWay">One Way</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="roundWay">
                                <label class="form-check-label" for="roundWay">Round Way</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="multiCity">
                                <label class="form-check-label" for="multiCity">Multi City</label>
                            </div>
                        </div>

                        <!-- From & To -->
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">From</label>
                            <input type="text" class="form-control" value="Dhaka" readonly>
                            <small>DAC, Hazrat Shahjalal International Ai...</small>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">To</label>
                            <input type="text" class="form-control" value="Cox's Bazar" readonly>
                            <small>CXB, Cox's Bazar Airport</small>
                        </div>

                        <!-- Dates -->
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Departure Date</label>
                            <input type="text" class="form-control" value="28 Sep'25" readonly>
                            <small>Sunday</small>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Return Date</label>
                            <input type="text" class="form-control" placeholder="Save more on return flight"
                                readonly>
                        </div>

                        <!-- Traveler -->
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Traveler, Class</label>
                            <input type="text" class="form-control" value="1 Traveler" readonly>
                            <small>Economy</small>
                        </div>

                        <!-- Overlapping Button (must NOT be inside a Bootstrap column) -->
                        <button type="submit" class="search-btn">Search</button>
                    </form>
                </div>


                <div class="tab-pane fade" id="tour">
                    <form class="search-box row g-4">
                        <!-- Trip Type -->
                        <div class="col-12 text-center">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="oneWay"
                                    checked>
                                <label class="form-check-label" for="oneWay">One Way</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="roundWay">
                                <label class="form-check-label" for="roundWay">Round Way</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="multiCity">
                                <label class="form-check-label" for="multiCity">Multi City</label>
                            </div>
                        </div>

                        <!-- From & To -->
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">From</label>
                            <input type="text" class="form-control" value="Dhaka" readonly>
                            <small>DAC, Hazrat Shahjalal International Ai...</small>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">To</label>
                            <input type="text" class="form-control" value="Cox's Bazar" readonly>
                            <small>CXB, Cox's Bazar Airport</small>
                        </div>

                        <!-- Dates -->
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Departure Date</label>
                            <input type="text" class="form-control" value="28 Sep'25" readonly>
                            <small>Sunday</small>
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Return Date</label>
                            <input type="text" class="form-control" placeholder="Save more on return flight"
                                readonly>
                        </div>

                        <!-- Traveler -->
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Traveler, Class</label>
                            <input type="text" class="form-control" value="1 Traveler" readonly>
                            <small>Economy</small>
                        </div>

                        <!-- Overlapping Button (must NOT be inside a Bootstrap column) -->
                        <button type="submit" class="search-btn">Search</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="visa">Visa content here...</div>
            </div>
        </div>

    </div>
</section>

<script>
    $(function() {
        let start = moment().subtract(7, 'days');
        let end = moment();

        function cb(start, end) {
            $('#depature').val(start.format('YYYY-MM-DD'));
            $('#return').val(end.format('YYYY-MM-DD'));
        }

        // initialize daterangepicker (attached to body, not specific input)
        $('#dep, #end_date').on('click', function() {
            $('body').daterangepicker({
                startDate: start,
                endDate: end,
                opens: 'center',
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                }
            }, cb).click(); // trigger click to open popup
        });
    });
</script>
