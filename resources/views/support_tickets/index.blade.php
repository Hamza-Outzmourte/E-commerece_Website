@extends('layouts.app')

@section('content')
<h1>Mes Tickets de Support</h1>

<a href="{{ route('support_tickets.create') }}" class="btn btn-primary mb-4">Créer un nouveau ticket</a>

@if($tickets->count())
    <ul>
        @foreach($tickets as $ticket)
            <li>
                <a href="{{ route('support_tickets.show', $ticket) }}">
                    [{{ ucfirst($ticket->status) }}] {{ $ticket->subject }} ({{ ucfirst($ticket->priority) }})
                </a>
            </li>
        @endforeach
    </ul>

    {{ $tickets->links() }}
@else
    <p>Aucun ticket trouvé.</p>
@endif
@endsection
