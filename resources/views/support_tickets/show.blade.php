@extends('layouts.app')

@section('content')
<h1>Détail du ticket</h1>

<h2>{{ $supportTicket->subject }}</h2>
<p>Status : {{ ucfirst($supportTicket->status) }}</p>
<p>Priorité : {{ ucfirst($supportTicket->priority) }}</p>
<p>Description : </p>
<p>{{ $supportTicket->description }}</p>
<p>Créé le : {{ $supportTicket->created_at->format('d/m/Y H:i') }}</p>

<a href="{{ route('support_tickets.index') }}">Retour à la liste</a>
@endsection
