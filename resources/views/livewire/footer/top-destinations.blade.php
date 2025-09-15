<div class="col-lg-2 col-md-6 col-sm-6">
    <div class="footer-widget">
        <h5 class="footer-title">Destinations</h5>
        @if($this->destinations->isNotEmpty())
            <ul class="footer-menu">
                @foreach($this->destinations as $destination)
                    {{-- প্রতিটি এলাকাকে Properties পেজের লিঙ্কে পরিণত করা হয়েছে --}}
                    <li>
                        <a href="{{ route('listing.rent', ['address_area' => $destination->address_area]) }}">
                            {{ $destination->address_area }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
