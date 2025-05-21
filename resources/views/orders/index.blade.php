@extends('layouts.app') {{-- ou adapte selon ton layout --}}

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Mes commandes</h1>

    @if($orders->isEmpty())
        <div class="text-gray-600">Vous n'avez passé aucune commande pour l’instant.</div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="p-4 border rounded-lg shadow-sm bg-white">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-lg font-semibold">Commande #{{ $order->id }}</h2>
                        <span class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="text-sm text-gray-700">
                        <p><strong>Nom :</strong> {{ $order->name }}</p>
                        <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
                        <p><strong>Adresse :</strong> {{ $order->address }}</p>
                        <p><strong>Statut :</strong> <span class="text-blue-600">{{ ucfirst($order->status) }}</span></p>
                        <p><strong>Total :</strong> {{ number_format($order->total, 2) }} DH</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

