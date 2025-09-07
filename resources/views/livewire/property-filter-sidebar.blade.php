<div class="col-lg-3 theiaStickySidebar">
    <div class="filter-sidebar rent-grid-sidebar-item-02 mb-lg-0">
        <div class="filter-head d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Filter</h5>
            <a href="#" class="text-danger">Reset</a>
        </div>
        <div class="filter-body">

            <!-- Input and Select -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#search" aria-expanded="false" role="button">
                        <h6 class="d-inline-flex align-items-center mb-0"><i class="material-icons-outlined me-2 text-secondary">search</i>Search</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="search" class="card-collapse collapse show mt-3">
                    <div class="input-group input-group-flat mb-3">
                            <span class="input-group-text border-0">
                                <i class="material-icons-outlined">search</i>
                            </span>
                        <input type="text" class="form-control" placeholder="Search here...">
                    </div>

                    <!-- Purpose -->
                    <div class="mb-2">
                        <label class="form-label mb-1">Purpose</label>
                        <select class="select" name="purpose">
                            <option value="">Select One</option>
                            <option value="rent">Rent</option>
                            <option value="sell">Sell</option>
                        </select>
                    </div>

                    <!-- Rent Type -->
                    <div class="mb-2">
                        <label class="form-label mb-1">Rent Type</label>
                        <select class="select" name="rent_type">
                            <option value="">Select One</option>
                            <option value="day">Day</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                            <option value="year">ear</option>
                        </select>
                    </div>

                    <!-- Negotiable -->
                    <div class="mb-2">
                        <label class="form-label mb-1">Negotiable</label>
                        <select class="select" name="is_negotiable">
                            <option value="">Select One</option>
                            <option value="negotiable">Negotiable</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>

                    <!-- Bedrooms -->
                    <div class="mb-2">
                        <label class="form-label mb-1">No of Bedrooms</label>
                        <select class="select" name="bathrooms">
                            <option>Select</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>

                    <!-- Bathrooms -->
                    <div class="mb-2">
                        <label class="form-label mb-1">No of Bathrooms</label>
                        <select class="select" name="bathrooms">
                            <option>Select</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <!-- Balconies -->
                    <div class="mb-2">
                        <label class="form-label mb-1">No of Balconies</label>
                        <select class="select" name="balconies">
                            <option>Select</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <!-- Floor Level -->
                    <div class="mb-2">
                        <label class="form-label mb-1">Floor Level</label>
                        <select class="select" name="floor_level">
                            <option>Select</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <!-- Total Floor -->
                    <div class="mb-2">
                        <label class="form-label mb-1">Total Floor</label>
                        <select class="select" name="total_floors">
                            <option>Select</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>

                    <div>
                        <label class="form-label mb-1"> Min Sqft </label>
                        <div class="input-group input-group-flat mb-0">
                            <input type="text" name="size_sqft" class="form-control" placeholder="Search here...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#additional" aria-expanded="false" role="button">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Additional</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="additional" class="card-collapse collapse show mt-3">
                    <div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="is_featured" type="checkbox" id="check_1">
                            <label class="form-check-label ms-2" for="check_1">
                                Featured (45)
                            </label>
                        </div>

                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="is_trending" type="checkbox" id="check_1">
                            <label class="form-check-label ms-2" for="check_1">
                                Trending (45)
                            </label>
                        </div>

                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="is_verified" type="checkbox" id="check_1">
                            <label class="form-check-label ms-2" for="check_1">
                                Verified (45)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Type -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#propertyType" aria-expanded="false" role="button">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Property Type</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="propertyType" class="card-collapse collapse show mt-3">
                    <div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_1">
                            <label class="form-check-label ms-2" for="check_1">
                                Apartments (45)
                            </label>
                        </div>
                        <div class="more-menu mt-2">
                            <div class="form-check d-flex align-items-center ps-0 mb-2">
                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_3">
                                <label class="form-check-label ms-2" for="check_3">
                                    Houses (24)
                                </label>
                            </div>
                        </div>
                        <div class="view-all d-inline-flex align-items-center">
                            <a href="javascript:void(0);" class="viewall-button text-secondary">See More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tenant Type -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#tenantType" aria-expanded="false" role="button">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Tenant Type</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="tenantType" class="card-collapse collapse show mt-3">
                    <div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_1">
                            <label class="form-check-label ms-2" for="check_1">
                                Family (45)
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_1">
                            <label class="form-check-label ms-2" for="check_1">
                                Bachelor Male (45)
                            </label>
                        </div>
                        <div class="more-menu mt-2">
                            <div class="form-check d-flex align-items-center ps-0 mb-2">
                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_3">
                                <label class="form-check-label ms-2" for="check_3">
                                    Sublet (24)
                                </label>
                            </div>
                        </div>
                        <div class="view-all d-inline-flex align-items-center">
                            <a href="javascript:void(0);" class="viewall-button text-secondary">See More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amenities -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#amenities" aria-expanded="false" role="button">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">cake</i>Amenities</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="amenities" class="card-collapse collapse show mt-3">
                    <div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_7">
                            <label class="form-check-label ms-2" for="check_7">
                                Backyard (34)
                            </label>
                        </div>
                        <div class="more-menu1 mt-2">
                            <div class="form-check d-flex align-items-center ps-0 mb-2">
                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_10">
                                <label class="form-check-label ms-2" for="check_10">
                                    Elevator (16)
                                </label>
                            </div>
                        </div>
                        <div class="view-all d-inline-flex align-items-center">
                            <a href="javascript:void(0);" class="viewall1-button text-secondary">See More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Price -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false" role="button">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">monetization_on</i>Price</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="price" class="card-collapse collapse show mt-3">
                    <div>
                        <div class="filter-range">
                            <input type="text" id="range_03">
                            <p class="mb-0">Range : <span class="text-dark">$200 - $5695</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#reviews" aria-expanded="false" role="button">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">auto_awesome</i>Reviews</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="reviews" class="card-collapse collapse show mt-3">
                    <div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_12">
                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_12">
														<span class="review-star mb-0 d-flex align-items-center">
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                        </span>
                                <span class="ms-2 mb-0"> 5 Star </span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_13">
                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_13">
														<span class="review-star mb-0 d-flex align-items-center">
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                        </span>
                                <span class="ms-2 mb-0"> 4 Star </span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_14">
                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_14">
                                                        <span class="review-star mb-0 d-flex align-items-center">
                                                        <i class="material-icons text-warning">star</i>
                                                        <i class="material-icons text-warning">star</i>
                                                        <i class="material-icons text-warning">star</i>
                                                    </span>
                                <span class="ms-2 mb-0"> 3 Star </span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_15">
                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_15">
                                                        <span class="review-star mb-0 d-flex align-items-center">
                                                        <i class="material-icons text-warning">star</i>
                                                        <i class="material-icons text-warning">star</i>
                                                    </span>
                                <span class="ms-2 mb-0"> 2 Star </span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center ps-0 mb-0">
                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_16">
                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_16">
														<span class="review-star mb-0 d-flex align-items-center">
                                                            <i class="material-icons text-warning">star</i>
                                                        </span>
                                <span class="ms-2 mb-0"> 1 Star </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="filter-footer">
            <a href="#" class="btn btn-dark w-100"> Apply Filter </a>
        </div>
    </div>
</div>  <!-- end col -->
