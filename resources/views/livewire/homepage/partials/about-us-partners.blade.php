<div class="row align-items-center row-gap-4">
    @foreach($this->partners as $partner)
        <div class="col-md-6 col-lg-2 d-flex">
            <div class="card border-0 bg-light shadow-none flex-fill mb-0">
                <div class="card-body text-center">
                    @if($partner->website_url)
                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $partner->getFirstMediaUrl('logos') }}" alt="{{ $partner->name }} Logo" class="img-fluid">
                        </a>
                    @else
                        <img src="{{ $partner->getFirstMediaUrl('logos') }}" alt="{{ $partner->name }} Logo" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
