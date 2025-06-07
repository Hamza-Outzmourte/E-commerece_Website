@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Mes Tickets de Support</h1>
        <a href="{{ route('support_tickets.create') }}"
           class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-700 transition">
            + Créer un nouveau ticket
        </a>
    </div>

    @if($tickets->count())
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($tickets as $ticket)
                <a href="{{ route('support_tickets.show', $ticket) }}"
                   class="block px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Statut :
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ ucfirst($ticket->status) }}</span>
                            </p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $ticket->subject }}
                            </p>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                            {{ $ticket->priority === 'haute' ? 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-white' : ($ticket->priority === 'moyenne' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-700 dark:text-white' : 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-white') }}">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $tickets->links() }}
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 dark:bg-yellow-100 dark:text-yellow-900 rounded-md p-4">
            <p>Aucun ticket trouvé.</p>
        </div>
    @endif
</div>
@endsection
