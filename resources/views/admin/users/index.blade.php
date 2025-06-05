@extends('layouts.admin')

@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="bg-white shadow-lg rounded-xl p-0 md:p-6 text-gray-800 h-screen">

  <!-- Titre -->
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 px-4 md:px-0">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-2">
      <i class="fas fa-users text-indigo-600"></i>
      Gestion des utilisateurs
    </h1>
    <a href="{{ route('admin.users.create') }}"
       class="inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-indigo-100 to-purple-200 hover:from-indigo-200 hover:to-purple-300 text-gray-900 font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 no-underline">
      <i class="fas fa-user-plus mr-2"></i> Ajouter un utilisateur
    </a>
  </div>

  <!-- Filtres -->
  <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6 px-4 md:px-0">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par nom ou email"
           class="px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-900" />

    <select name="role" class="px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-900">
      <option value="">Tous les rôles</option>
      @foreach(['admin' => 'Administrateur', 'user' => 'Utilisateur'] as $value => $label)
        <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>

    <select name="status" class="px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-900">
      <option value="">Tous les statuts</option>
      @foreach(['active' => 'Actif', 'inactive' => 'Inactif'] as $value => $label)
        <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>

    <div class="flex gap-2">
      <button type="submit"
              class="flex-1 bg-indigo-200 hover:bg-indigo-300 text-gray-900 font-semibold py-3 px-4 rounded-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300">
        Filtrer
      </button>
      <a href="{{ route('admin.users.index') }}"
         class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-md transition duration-300 flex items-center justify-center"
         title="Réinitialiser les filtres">
        <i class="fas fa-times"></i>
      </a>
    </div>
  </form>

  <!-- Export -->
  <div class="mb-6 flex flex-wrap justify-between items-center gap-4 px-4 md:px-0">
    <div class="flex gap-3">
      <a href="{{ route('admin.users.export', ['format' => 'csv'] + request()->query()) }}"
         class="flex items-center gap-2 bg-blue-200 hover:bg-blue-300 px-4 py-2 rounded-md text-sm text-gray-900 transition duration-200">
        <i class="fas fa-file-csv"></i> Export CSV
      </a>
      <a href="{{ route('admin.users.export', ['format' => 'pdf'] + request()->query()) }}"
         class="flex items-center gap-2 bg-red-200 hover:bg-red-300 px-4 py-2 rounded-md text-sm text-gray-900 transition duration-200">
        <i class="fas fa-file-pdf"></i> Export PDF
      </a>
    </div>
    <div class="text-sm text-gray-600">
      {{ $users->total() }} utilisateur(s) trouvé(s)
    </div>
  </div>

  <!-- Messages -->
  @if(session('success'))
    <div class="mb-6 mx-4 md:mx-0 p-4 rounded-md bg-green-100 text-green-800 flex items-center gap-2">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="mb-6 mx-4 md:mx-0 p-4 rounded-md bg-red-100 text-red-800 flex items-center gap-2">
      <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
  @endif

  <!-- Tableau plein écran -->
  <div class="w-full overflow-x-auto rounded-lg border border-gray-200 shadow">
    <table class="min-w-full divide-y divide-gray-200 text-gray-900">
      <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-600">
        <tr>
          <th scope="col" class="px-6 py-3 text-left">Nom</th>
          <th scope="col" class="px-6 py-3 text-left">Email</th>
          <th scope="col" class="px-6 py-3 text-left">Rôle</th>
          <th scope="col" class="px-6 py-3 text-left">Statut</th>
          <th scope="col" class="px-6 py-3 text-left">Créé le</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-200">
        @forelse ($users as $user)
          <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
            <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
            <td class="px-6 py-4 break-all">{{ $user->email }}</td>
            <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
            <td class="px-6 py-4">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ ucfirst($user->status) }}
              </span>
            </td>
            <td class="px-6 py-4">{{ $user->created_at->translatedFormat('d/m/Y') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="p-12 text-center">
              <div class="flex flex-col items-center justify-center space-y-4">
                <i class="fas fa-user-slash text-4xl text-gray-400"></i>
                <p class="text-lg text-gray-600">Aucun utilisateur trouvé</p>
                <a href="{{ route('admin.users.create') }}" class="mt-2 inline-flex items-center px-4 py-2 bg-indigo-200 hover:bg-indigo-300 text-gray-900 rounded-md shadow-sm transition duration-200">
                  Créer un utilisateur
                </a>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination -->
  @if($users->hasPages())
    <div class="mt-8 px-4 md:px-0">
      {{ $users->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>
  @endif

</div>
@endsection
