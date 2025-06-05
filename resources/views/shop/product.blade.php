<h3>Avis clients</h3>

@foreach($product->reviews as $review)
    <div class="review">
        <strong>{{ $review->user->name }}</strong>
        <span>{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</span>
        <p>{{ $review->comment }}</p>
        <small>Posté le {{ $review->created_at->format('d/m/Y') }}</small>
        <h4>Note moyenne : {{ number_format($product->averageRating(), 1) }} / 5</h4>

    </div>

@endforeach

@if($product->reviews->isEmpty())
    <p>Aucun avis pour le moment.</p>
@endif
