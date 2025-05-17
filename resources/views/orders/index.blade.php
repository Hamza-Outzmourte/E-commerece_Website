@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-4">Mes commandes</h1>

        @if (count($orders) === 0)
            <p>Vous n'avez aucune commande.</p>
        @else
            <ul>
                @foreach($orders as $order)
                    <li>Commande #{{ $order->id }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
