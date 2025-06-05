@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Mes demandes de retour</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($returnRequests->isEmpty())
        <p>Aucune demande de retour pour le moment.</p>
    @else
        <table class="w-full border border-gray-300 rounded-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Commande</th>
                    <th class="border p-2">Raison</th>
                    <th class="border p-2">Détails</th>
                    <th class="border p-2">Statut</th>
                    <th class="border p-2">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($returnRequests as $request)
                <tr>
                    <td class="border p-2">{{ $request->order_id }}</td>
                    <td class="border p-2">{{ $request->reason }}</td>
                    <td class="border p-2">{{ $request->details ?? '-' }}</td>
                    <td class="border p-2 capitalize">{{ $request->status }}</td>
                    <td class="border p-2">{{ $request->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('return_requests.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Créer une nouvelle demande
    </a>
</div>
@endsection
