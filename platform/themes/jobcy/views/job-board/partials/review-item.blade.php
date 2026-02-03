<div class="d-sm-flex align-items-top">
    <div class="flex-shrink-0">
        <img class="rounded-circle avatar-md img-thumbnail" src="{{ $review->account->avatar_url }}" alt="{{ $review->account->name }}">
    </div>
    <div class="flex-grow-1 ms-sm-3">
        <div>
            <p class="text-muted float-end fs-14 mb-2">{{ $review->created_at?->diffForHumans() }}</p>
            <h6 class="mt-sm-0 mt-3 mb-1">{{ $review->account->name }}</h6>
            <div class="review-rating mb-2">
                @for($i = 0; $i < $review->star; $i++)
                    <i class="mdi mdi-star text-warning"></i>
                @endfor

                @for($i = 0; $i < (5 - $review->star); $i++)
                    <i class="mdi mdi-star text-muted"></i>
                @endfor
            </div>
            <p class="text-muted fst-italic">{{ $review->review }}</p>
        </div>
    </div>
</div>
