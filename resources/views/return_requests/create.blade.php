@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Créer une demande de retour</h1>

    <form action="{{ route('return_requests.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="order_id" class="block font-medium mb-1">Commande</label>
            <select name="order_id" id="order_id" required class="w-full border rounded p-2">
                <option value="">-- Sélectionner une commande --</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ old('order_id') == $order->id ? 'selected' : '' }}>
                        Commande #{{ $order->id }} - {{ $order->created_at->format('d/m/Y') }} - {{ number_format($order->total, 2, ',', ' ') }} €
                    </option>
                @endforeach
            </select>
            @error('order_id')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="reason" class="block font-medium mb-1">Raison</label>
            <input type="text" name="reason" id="reason" value="{{ old('reason') }}" required class="w-full border rounded p-2" />
            @error('reason')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="details" class="block font-medium mb-1">Détails (optionnel)</label>
            <textarea name="details" id="details" rows="4" class="w-full border rounded p-2">{{ old('details') }}</textarea>
            @error('details')<p class="text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            Envoyer la demande
        </button>
    </form>
</div>
@endsection
