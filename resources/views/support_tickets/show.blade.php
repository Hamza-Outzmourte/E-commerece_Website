@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Détail du ticket</h1>

        <h2 class="text-xl font-semibold text-blue-600 dark:text-blue-400 mb-2">{{ $supportTicket->subject }}</h2>

        <div class="space-y-2 text-gray-700 dark:text-gray-300">
            <p><span class="font-medium">Statut :</span>
                <span class="inline-block px-2 py-1 rounded
                {{ $supportTicket->status === 'ouvert' ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-white' : 'bg-gray-200 text-gray-800 dark:bg-gray-600 dark:text-white' }}">
                    {{ ucfirst($supportTicket->status) }}
                </span>
            </p>

            <p><span class="font-medium">Priorité :</span>
                <span class="inline-block px-2 py-1 rounded
                {{ $supportTicket->priority === 'haute' ? 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-white' : ($supportTicket->priority === 'moyenne' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-700 dark:text-white' : 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-white') }}">
                    {{ ucfirst($supportTicket->priority) }}
                </span>
            </p>

            <p><span class="font-medium">Description :</span></p>
            <div class="bg-gray-50 dark:bg-gray-700 rounded p-3 text-sm whitespace-pre-line">
                {{ $supportTicket->description }}
            </div>

            <p><span class="font-medium">Créé le :</span> {{ $supportTicket->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="mt-6">
            <a href="{{ route('support_tickets.index') }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                ← Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection

