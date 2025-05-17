@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
    <h1 class="mb-4">Liste des utilisateurs</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">➕ Ajouter un utilisateur</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">✏️</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑️</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

