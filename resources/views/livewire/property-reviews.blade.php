<div class="accordion-item mb-xl-0">
    <div class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-9" aria-expanded="true">
            Reviews
        </button>
    </div>
    <div id="accordion-9" class="accordion-collapse collapse show">
        <div class="accordion-body">
            {{-- নতুন Alpine.js চালিত Alert --}}
            <div
                x-data="{ show: false, message: '' }"
                x-show="show"
                x-on:show-review-success.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 5000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4"
                class="alert alert-success"
                style="display: none;" {{-- FOUC (Flash of Unstyled Content) এড়ানোর জন্য --}}
            >
                <span x-text="message"></span>
            </div>

            <div class="sub-head d-flex align-items-center justify-content-between mb-4">
                <h6 class="fs-16 fw-semibold"> Reviews ({{ $property->approvedReviews()->count() }}) </h6>
                @auth
                    {{-- এই নতুন if-else ব্লকটি যোগ করুন --}}
                    @if($this->hasAlreadyReviewed)
                        <div class="alert alert-info py-2 px-3 mb-0">
                            <i class="material-icons-outlined me-1 fs-16 align-middle">check_circle</i> You've already reviewed this property.
                        </div>
                    @else
                        <a href="javascript:void(0);" class="btn btn-dark d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#add_review_modal">
                            <i class="material-icons-outlined me-1 fs-13">edit_note</i> Write a Review
                        </a>
                    @endif
                @else
                    <a href="{{ route('filament.superadmin.auth.login') }}" class="btn btn-dark d-flex align-items-center">
                        <i class="material-icons-outlined me-1 fs-13">login</i> Login to Review
                    </a>
                @endauth
            </div>

            {{-- যদি সার্ভার-সাইড থেকে কোনো এরর আসে, তা দেখানোর জন্য --}}
            @if(session('review_error'))
                <div class="alert alert-danger">{{ session('review_error') }}</div>
            @endif

            <!-- Rating Summary -->
            <div class="row mb-3  gap-xl-0 gap-lg-0 gap-3">
                <div class="col-lg-6 d-flex">
                    <div class="p-4 bg-light rounded text-center d-flex align-items-center justify-content-center flex-column flex-fill">
                        <h6 class="fs-16 fw-medium mb-3"> Customer Reviews & Ratings </h6>
                        <div class="mb-3">
                            <h2 class="mb-1">
                                {{ number_format($property->average_rating, 1) }}
                                <span class="fs-16 text-body fw-normal"> / 5.0</span>
                            </h2>
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="material-icons-outlined fs-14 {{ $i <= round($property->average_rating) ? 'text-warning' : 'text-gray-300' }}">star</i>
                                @endfor
                            </div>
                        </div>
                        <p class="mb-0 fs-14"> Based On {{ $property->reviews_count }} Reviews </p>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-6 d-flex">
                    <div class="card shadow-none review-progress flex-fill mb-0">
                        <div class="card-body ">
                            <!-- Progress 1 -->
                            @foreach($this->ratingDistribution as $rating => $data)
                                <div class="progress-lvl {{ $loop->last ? 'mb-0' : 'mb-2' }}">
                                    <p>{{ $rating }} Star Ratings</p>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $data['percentage'] }}%" aria-valuenow="{{ $data['percentage'] }}"></div>
                                    </div>
                                    <p>{{ $data['count'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

            <!-- Review List -->
            @foreach($this->reviews as $review)
               <div wire:key="review-{{ $review->id }}" class="card shadow-none review-items {{ !$loop->last ? 'mb-4' : '' }}">
                    <div class="card-body">
                        <div class="mb-4"> {{-- Removed mb-4 for tighter design --}}
                            <div class="d-flex align-center flex-wrap justify-content-between gap-1 mb-2">
                                <div class="d-flex align-center gap-2 flex-wrap">
                                    <div class="avatar avatar-lg">
                                        <img src="{{ $review->user->avatar_url ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $review->user->name }}" class="img-fluid rounded-circle">
                                    </div>
                                    <div class="">
                                        <h6 class="fs-16 fw-medium mb-1">{{ $review->user->name }}</h6>
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="fs-14 mb-0 text-body">{{ $review->created_at->diffForHumans() }}</p>
                                            <i class="fa-solid fa-circle text-body"></i>
                                            <div class="d-flex align-items-center justify-content-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="material-icons-outlined {{ $i <= $review->rating ? 'text-warning' : '' }}">star</i>
                                                @endfor
                                            </div>
                                            <p class="fs-14 mb-0 text-body">{{ $review->title }}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- মালিকের জন্য Reply বাটন দেখানো যেতে পারে --}}
                                {{-- <a href="javascript:void(0);" class="btn d-inline-flex align-items-center fs-13 fw-semibold reply-btn"><i class="material-icons-outlined text-dark me-1">repeat</i>Reply</a> --}}
                            </div>
                            <p class="mb-2 text-body">{{ $review->body }}</p>

                            {{-- Like/Dislike কার্যকারিতা ভবিষ্যতে যোগ করা যেতে পারে --}}
                            {{-- ডাইনামিক Interaction বাটন --}}
                            <div class="d-flex align-items-center gap-3">
                                <a href="javascript:void(0);" wire:click.prevent="toggleInteraction({{ $review->id }}, 'like')" class="mb-0 d-flex align-items-center fs-14 text-decoration-none {{ isset($userInteractions[$review->id]) && $userInteractions[$review->id] === 'like' ? 'text-primary fw-bold' : 'text-body' }}">
                                    <i class="material-icons-outlined me-1 fs-14">thumb_up</i>
                                    {{ $review->likes_count }}
                                </a>
                                <a href="javascript:void(0);" wire:click.prevent="toggleInteraction({{ $review->id }}, 'dislike')" class="mb-0 d-flex align-items-center fs-14 text-decoration-none {{ isset($userInteractions[$review->id]) && $userInteractions[$review->id] === 'dislike' ? 'text-primary fw-bold' : 'text-body' }}">
                                    <i class="material-icons-outlined me-1 fs-14">thumb_down</i>
                                    {{ $review->dislikes_count }}
                                </a>
                                <a href="javascript:void(0);" wire:click.prevent="toggleInteraction({{ $review->id }}, 'favorite')" class="mb-0 d-flex align-items-center fs-14 text-decoration-none {{ isset($userInteractions[$review->id]) && $userInteractions[$review->id] === 'favorite' ? 'text-danger fw-bold' : 'text-body' }}">
                                    <i class="material-icons-outlined me-1 fs-14">favorite</i>
                                    {{ $review->favorites_count }}
                                </a>
                            </div>
                        </div>

                        {{-- Replies --}}
                        @if($review->replies->isNotEmpty())
                            @foreach($review->replies as $reply)
                                <div wire:key="reply-{{ $reply->id }}" class="card shadow-none review-items bg-light border-0 mb-0 ms-lg-5 ms-md-5 ms-3">
                                    <div class="card-body">
                                        <div class="d-flex align-center flex-wrap justify-content-between gap-1 mb-2">
                                            <div class="d-flex align-center gap-2 flex-wrap">
                                                <div class="avatar avatar-lg">
                                                    <img src="{{ $reply->user->avatar_url ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $reply->user->name }}" class="img-fluid rounded-circle">
                                                </div>
                                                <div class="">
                                                    <h6 class="fs-16 fw-medium mb-1">{{ $reply->user->name }}
                                                        @if($reply->user_id === $property->user_id)
                                                            <span class="badge bg-primary ms-1">Owner</span>
                                                        @endif
                                                    </h6>
                                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                                        <p class="fs-14 mb-0 text-body">{{ $reply->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-2 text-body">{{ $reply->body }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    </div>
            @endforeach

            {{-- যদি মোট রিভিউর সংখ্যা প্রাথমিকভাবে দেখানো সংখ্যার চেয়ে বেশি হয়, তবেই "See All" বাটন দেখান --}}
            @if($this->allReviews->count() > $this->initialDisplayCount)
                <div class="text-center mt-4">
                    <a href="javascript:void(0);" class="btn btn-dark d-inline-flex align-center gap-1" data-bs-toggle="modal" data-bs-target="#all_reviews_modal">
                        See All {{ $this->allReviews->count() }} Reviews
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Review Modal -->
    <div wire:ignore.self id="add_review_modal" class="modal fade" tabindex="-1" aria-labelledby="addReviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form wire:submit.prevent="submitReview">
                    <div class="modal-header">
                        <h4 class="text-dark modal-title fw-bold" id="addReviewLabel">Write a Review for {{ $property->title }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Your Rating</label>
                            <div class="selection-wrap">
                                <div class="d-inline-block">
                                    <div class="rating-selction">
                                        <input type="radio" wire:model="rating" value="5" id="rating5">
                                        <label for="rating5"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" wire:model="rating" value="4" id="rating4">
                                        <label for="rating4"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" wire:model="rating" value="3" id="rating3">
                                        <label for="rating3"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" wire:model="rating" value="2" id="rating2">
                                        <label for="rating2"><i class="fa-solid fa-star"></i></label>
                                        <input type="radio" wire:model="rating" value="1" id="rating1">
                                        <label for="rating1"><i class="fa-solid fa-star"></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Review Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" wire:model="title" placeholder="e.g., Excellent Stay!">
                            @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold">Write your review</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" rows="4" wire:model="body" placeholder="Describe your experience..."></textarea>
                            @error('body') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="submitReview">Submit Review</span>
                            <span wire:loading wire:target="submitReview">Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Modal -->

    <!-- 2. "See All Reviews" Modal -->
    <div wire:ignore.self id="all_reviews_modal" class="modal fade" tabindex="-1" aria-labelledby="allReviewsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable"> {{-- Scrollable and larger modal --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allReviewsLabel">All Reviews for {{ $property->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if($this->allReviews->isNotEmpty())
                        @foreach($this->allReviews as $review)
                            {{-- এখানে আপনার রিভিউ কার্ডের HTML আবার ব্যবহার করুন --}}
                            <div wire:key="modal-review-{{ $review->id }}" class="card shadow-none review-items {{ !$loop->last ? 'mb-4' : '' }}">
                                <div class="card-body">
                                    {{-- ... রিভিউ কার্ডের সম্পূর্ণ কন্টেন্ট ... --}}
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>No reviews found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            const reviewModalElement = document.getElementById('add_review_modal');

            if (reviewModalElement) {
                const reviewModal = new bootstrap.Modal(reviewModalElement);

                // সফলভাবে সাবমিট হওয়ার পর মডাল বন্ধ করার জন্য
                Livewire.on('review-submitted', () => {
                    reviewModal.hide();
                });

                // *** নতুন কোড: মডাল বন্ধ হয়ে গেলে Livewire-কে জানানো ***
                reviewModalElement.addEventListener('hidden.bs.modal', event => {
                    // একটি ব্রাউজার ইভেন্ট dispatch করা হচ্ছে যা Livewire কম্পোনেন্ট শুনবে
                    Livewire.dispatch('resetReviewForm');
                });
            }
        });
    </script>
@endpush
