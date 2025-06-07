@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Mes demandes de retour</h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-100 rounded-md shadow">
            {{ session('success') }}
        </div>
    @endif

    @if($returnRequests->isEmpty())
        <p class="text-gray-600 dark:text-gray-300">Aucune demande de retour pour le moment.</p>
    @else
        <div class="overflow-x-auto shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800 rounded-md">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-left">Commande</th>
                        <th class="px-4 py-3 text-left">Raison</th>
                        <th class="px-4 py-3 text-left">Détails</th>
                        <th class="px-4 py-3 text-left">Statut</th>
                        <th class="px-4 py-3 text-left">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                    @foreach($returnRequests as $request)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-4 py-3">{{ $request->order_id }}</td>
                        <td class="px-4 py-3">{{ $request->reason }}</td>
                        <td class="px-4 py-3">{{ $request->details ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs font-medium rounded
                                {{ $request->status === 'acceptée' ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-white' :
                                   ($request->status === 'refusée' ? 'bg-red-100 text-red-800 dark:bg-red-700 dark:text-white' :
                                   'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-white') }}">
                                {{ ucfirst($request->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $request->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('return_requests.create') }}"
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg shadow transition">
            + Créer une nouvelle demande
        </a>
    </div>
</div>
@endsection
