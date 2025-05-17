@extends('layouts.app')

@section('header')
    Résultats pour "{{ $query }}"
@endsection

@section('content')
    @if ($results->isEmpty())
        <p>Aucun résultat trouvé.</p>
    @else
        <ul class="space-y-4">
            @foreach ($results as $item)
                <li class="border p-4 rounded shadow bg-white dark:bg-gray-800">
                    <h2 class="text-lg font-semibold">{{ $item->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300">{{ $item->description }}</p>
                </li>
            @endforeach
        </ul>
    @endif
@endsection

