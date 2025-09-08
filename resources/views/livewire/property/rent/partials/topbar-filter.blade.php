<div class="card border-0 search-item mb-4">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-lg-4">
                {{-- ডাইনামিক রেজাল্ট কাউন্ট --}}
                <p class="mb-4 mb-lg-0 mb-md-3 text-lg-start text-md-start text-center">
                    Showing <span class="result-value">{{ $properties->count() }}</span> of
                    <span class="result-value">{{ $totalPropertiesCount }}</span> results
                </p>
            </div>

            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3 flex-wrap justify-content-lg-end flex-lg-row flex-md-row flex-column">

                    {{-- শক্তিশালী এবং একক সর্টিং ড্রপডাউন --}}
                    <div class="result-list d-flex d-block flex-lg-row flex-md-row flex-column align-items-center gap-2">
                        <h5>Sort By</h5>
                        <div class="result-select"
                             style="min-width: 200px;" {{-- Select2-এর জন্য একটি নির্দিষ্ট প্রস্থ দেওয়া ভালো --}}
                             wire:ignore
                             x-data="select2Alpine({
                                             model: @entangle('sort_by'),
                                             livewireModel: 'sort_by',
                                             showSearch: false
                                         })"
                             x-init="init()">

                            <select class="select" x-ref="select">
                                <option value="score_desc">Best Match</option>
                                <option value="date_desc">Newest First</option>
                                <option value="price_asc">Price: Low to High</option>
                                <option value="price_desc">Price: High to Low</option>
                            </select>
                        </div>
                    </div>

                    {{-- ডাইনামিক ভিউ সুইচার --}}
                    <ul class="grid-list-view d-flex align-items-center justify-content-center">
                        <li>
                            <a href="#"
                               wire:click.prevent="$set('viewMode', 'list')"
                               class="list-icon {{ $viewMode === 'list' ? 'active' : '' }}">
                                <i class="material-icons">list</i>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               wire:click.prevent="$set('viewMode', 'grid')"
                               class="list-icon {{ $viewMode === 'grid' ? 'active' : '' }}">
                                <i class="material-icons">grid_view</i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
