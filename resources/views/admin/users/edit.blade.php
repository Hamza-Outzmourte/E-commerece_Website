@extends('layouts.admin')

@section('title', 'Modifier un utilisateur')

@section('content')
    <h1>Modifier l'utilisateur</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Optionnel : mettre à jour le mot de passe --}}
        <div class="mb-3">
            <label>Nouveau mot de passe (laisser vide pour ne pas changer)</label>
            <input type="password" name="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Confirmation mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
