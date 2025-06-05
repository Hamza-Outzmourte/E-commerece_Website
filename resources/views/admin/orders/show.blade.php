@extends('admin.dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-semibold mb-4">Détails de la commande #{{ $order->id }}</h1>

    <div class="mb-4">
        <p><strong>Client :</strong> {{ $order->user->name }}</p>
        <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p><strong>Total :</strong> {{ number_format($order->total, 2) }} €</p>
        <p><strong>Statut :</strong> {{ str_replace('_', ' ', $order->status) }}</p>
    </div>

    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mb-4">
        @csrf
        <label for="status" class="block mb-1">Changer le statut :</label>
        <select name="status" id="status" class="p-2 border rounded">
            <option value="en_attente" @selected($order->status === 'en_attente')>En attente</option>
            <option value="en_cours" @selected($order->status === 'en_cours')>En cours</option>
            <option value="expediee" @selected($order->status === 'expediee')>Expédiée</option>
            <option value="annulee" @selected($order->status === 'annulee')>Annulée</option>
        </select>
        <button type="submit" class="ml-2 bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>

    <h2 class="text-xl font-semibold mt-6 mb-2">Produits</h2>
    <ul class="bg-white shadow p-4 rounded">
        @foreach($order->orderItems as $item)
            <li class="border-b py-2">
                {{ $item->product->name }} x {{ $item->quantity }} — {{ number_format($item->price, 2) }} €
            </li>
        @endforeach
    </ul>
</div>
@endsection
