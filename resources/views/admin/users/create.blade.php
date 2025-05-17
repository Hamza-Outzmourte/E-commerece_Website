@extends('layouts.admin')

@section('title', 'Créer un utilisateur')

@section('content')
    <h1>Ajouter un utilisateur</h1>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirmation mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
