<a href="javascript:void(0);"
   wire:click.prevent="toggleWishlist"
   class="{{ $class }}"
   wire:loading.attr="disabled"
   title="{{ $isInWishlist ? 'Remove from Wishlist' : 'Add to Wishlist' }}">

    @if($isInWishlist)
        <i class="material-icons-outlined text-danger">favorite</i>
    @else
        <i class="material-icons-outlined">favorite_border</i>
    @endif
</a>
