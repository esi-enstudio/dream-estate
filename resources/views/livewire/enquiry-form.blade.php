<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Enquire Us</h5>
    </div>
    <div class="card-body">
        @if ($successMessage)
            <div class="alert alert-success">
                {{ $successMessage }}
            </div>
        @else
            <form wire:submit.prevent="submit">
                <div class="mb-3">
                    <label class="form-label fw-semibold"> Name </label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" wire:model="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold"> Email </label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your Email" wire:model="email">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold"> Phone </label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Your Phone Number" wire:model="phone">
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold"> Message </label>
                    <textarea class="form-control @error('message') is-invalid @enderror" rows="3" placeholder="I am interested in this property..." wire:model="message"></textarea>
                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-dark w-100 py-2 fs-14" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submit">Submit</span>
                        <span wire:loading wire:target="submit">Submitting...</span>
                    </button>
                </div>
            </form>
        @endif

{{--        <div class="mb-3">--}}
{{--            <label class="form-label fw-semibold"> Name </label>--}}
{{--            <input type="text" class="form-control" placeholder="Your Name">--}}
{{--        </div>--}}
{{--        <div class="mb-3">--}}
{{--            <label class="form-label fw-semibold"> Email </label>--}}
{{--            <input type="text" class="form-control" placeholder="Your Email">--}}
{{--        </div>--}}
{{--        <div class="mb-3">--}}
{{--            <label class="form-label fw-semibold"> Phone </label>--}}
{{--            <input type="text" class="form-control" placeholder="Your Phone Number">--}}
{{--        </div>--}}
{{--        <div class="mb-4">--}}
{{--            <label class="form-label fw-semibold"> Description </label>--}}
{{--            <textarea class="form-control" rows="3"></textarea>--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            <a href="#" class="btn btn-dark w-100 py-2 fs-14">Submit</a>--}}
{{--        </div>--}}
    </div> <!-- end card body-->
</div>
