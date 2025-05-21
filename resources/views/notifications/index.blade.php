@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Mes notifications</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($notifications->count())
        <form method="POST" action="{{ route('notifications.markAsRead') }}">
            @csrf
            <button type="submit" class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Marquer tout comme lu
            </button>
        </form>

        <ul class="space-y-2">
            @foreach($notifications as $notification)
                <li class="p-4 bg-white dark:bg-gray-800 rounded shadow-sm {{ $notification->read_at ? '' : 'border-l-4 border-blue-500' }}">
                    <p class="text-gray-800 dark:text-gray-200">
                        {{ $notification->data['message'] ?? 'Notification' }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $notification->created_at->diffForHumans() }}
                    </p>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600 dark:text-gray-300">Aucune notification trouvée.</p>
    @endif
</div>
@endsection
