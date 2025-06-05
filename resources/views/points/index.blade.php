@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Mes Points de Fidélité</h1>
    <p class="mb-6">Total des points : <strong>{{ $totalPoints }}</strong></p>

    @if($points->isEmpty())
        <p>Vous n'avez aucun point pour le moment.</p>
    @else
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Points</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($points as $point)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $point->created_at->format('d/m/Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $point->points }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $point->description ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
