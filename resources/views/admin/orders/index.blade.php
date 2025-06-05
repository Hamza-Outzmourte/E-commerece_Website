@extends('admin.dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Gestion des commandes</h1>

    {{-- Formulaire de filtres --}}
    <form method="GET" class="flex flex-wrap gap-4 mb-6 items-end">
        <div>
            <label for="status" class="block mb-1 font-medium">Statut</label>
            <select name="status" id="status" class="border rounded px-3 py-2">
                <option value="">Tous les statuts</option>
                <option value="en_attente" {{ request('status') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="en_cours" {{ request('status') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="expediee" {{ request('status') == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                <option value="annulee" {{ request('status') == 'annulee' ? 'selected' : '' }}>Annulée</option>
            </select>
        </div>

        <div>
            <label for="date_from" class="block mb-1 font-medium">Date de début</label>
            <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}" class="border rounded px-3 py-2">
        </div>

        <div>
            <label for="date_to" class="block mb-1 font-medium">Date de fin</label>
            <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}" class="border rounded px-3 py-2">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
            Filtrer
        </button>
    </form>

    {{-- Table des commandes --}}
    <table class="w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="p-3 border-b">ID</th>
                <th class="p-3 border-b">Client</th>
                <th class="p-3 border-b">Total (€)</th>
                <th class="p-3 border-b">Statut</th>
                <th class="p-3 border-b">Date</th>
                <th class="p-3 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $order->id }}</td>
                <td class="p-3">{{ $order->user->name }}</td>
                <td class="p-3">{{ number_format($order->total, 2) }}</td>
                <td class="p-3 capitalize">{{ str_replace('_', ' ', $order->status) }}</td>
                <td class="p-3">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-3 space-x-3">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="text-blue-600 hover:underline">Voir</a>
                    <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="text-green-600 hover:underline">Facture PDF</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-4 text-center text-gray-500">Aucune commande trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $orders->withQueryString()->links() }}
    </div>
</div>
@endsection
