@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>Prix :</strong> {{ number_format($product->price, 2) }} €</p>
    <p><strong>Stock :</strong> {{ $product->stock }}</p>

    @if($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="200">
    @endif

    <div class="mt-3">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</div>
@if(auth()->check())
<form method="POST" action="{{ route('reviews.store') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <label>Note :</label>
    <select name="rating" required>
        <option value="">Choisir une note</option>
        @for($i=1; $i<=5; $i++)
            <option value="{{ $i }}">{{ $i }} ★</option>
        @endfor
    </select>

    <label>Commentaire :</label>
    <textarea name="comment" rows="3"></textarea>

    <button type="submit">Envoyer l’avis</button>
</form>
@else
<p>Connecte-toi pour laisser un avis.</p>
@endif
<h3>Avis des clients :</h3>
@foreach($product->reviews as $review)
    <div class="mb-4">
        <strong>{{ $review->user->name }}</strong>
        <p>
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $review->rating)
                    ★
                @else
                    ☆
                @endif
            @endfor
        </p>
        <p>{{ $review->comment }}</p>
    </div>
@endforeach
<p>Note moyenne :
    @php $avg = round($product->averageRating()) @endphp
    @for($i = 1; $i <= 5; $i++)
        @if($i <= $avg)
            ★
        @else
            ☆
        @endif
    @endfor
</p>

@endsection

