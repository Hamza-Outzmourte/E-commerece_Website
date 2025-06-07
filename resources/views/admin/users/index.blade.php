@extends('layouts.admin')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('title', 'Gestion des utilisateurs')

@section('content')
<div class="bg-white shadow-xl rounded-xl p-4 sm:p-6 text-gray-800 h-full flex flex-col">

  <!-- En-tête -->
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 flex items-center gap-2">
      <button class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full" title="Utilisateurs">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 4.354a4 4 0 110 5.292M12 15v4m-6 0h12a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
        </svg>
      </button>
      Gestion des utilisateurs
    </h1>

    <button
      type="button"
      onclick="window.location='{{ route('admin.users.create') }}'"
      class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-black font-semibold rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center justify-center gap-2"
    >
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Ajouter un utilisateur
    </button>
  </div>

  <!-- Filtres -->
  <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher par nom ou email"
           class="px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 w-full" />

    <select name="role" class="px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 w-full">
      <option value="">Tous les rôles</option>
      @foreach(['admin' => 'Administrateur', 'user' => 'Utilisateur'] as $value => $label)
        <option value="{{ $value }}" {{ request('role') == $value ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>

    <select name="status" class="px-4 py-3 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 w-full">
      <option value="">Tous les statuts</option>
      @foreach(['active' => 'Actif', 'inactive' => 'Inactif'] as $value => $label)
        <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>

    <div class="flex gap-2 col-span-2 lg:col-span-1">
      <button type="submit"
              class="flex-1 bg-blue-600 hover:bg-blue-700 text-black font-semibold py-3 px-4 rounded-md transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        Filtrer
      </button>
      <a href="{{ route('admin.users.index') }}"
         class="flex-1 inline-flex items-center justify-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-4 rounded-md transition duration-300 group"
         title="Réinitialiser les filtres">
        <button type="button" class="bg-blue-600 group-hover:bg-blue-700 text-black p-1.5 rounded-full mr-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
        Réinit
      </a>
    </div>
  </form>

  <!-- Export & Count -->
  <div class="mb-6 flex flex-wrap justify-between items-center gap-4">
    <div class="flex gap-3">
      <a href="{{ route('admin.users.export', ['format' => 'csv'] + request()->query()) }}"
         class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm text-black transition duration-200">
        <button type="button" class="bg-blue-700 hover:bg-blue-800 text-white p-1.5 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
          </svg>
        </button>
        CSV
      </a>
      <a href="{{ route('admin.users.export', ['format' => 'pdf'] + request()->query()) }}"
         class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md text-sm text-white transition duration-200">
        <button type="button" class="bg-blue-700 hover:bg-blue-800 text-black p-1.5 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
          </svg>
        </button>
        PDF
      </a>
    </div>
    <div class="text-sm text-gray-600">
      {{ $users->total() }} utilisateur(s) trouvé(s)
    </div>
  </div>

  <!-- Messages -->
  @if(session('success'))
    <div class="mb-6 p-4 rounded-md bg-green-100 text-green-800 flex items-center gap-2">
      <button class="bg-green-600 text-black p-1.5 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </button>
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="mb-6 p-4 rounded-md bg-red-100 text-black flex items-center gap-2">
      <button class="bg-red-600 text-white p-1.5 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
      </button>
      {{ session('error') }}
    </div>
  @endif

  <!-- Tableau (plein écran) -->

    <table class="min-w-full divide-y divide-gray-200 text-gray-900">
      <thead class="bg-gray-100 text-xs uppercase tracking-wider text-gray-600 sticky top-0 z-10">
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
                <button class="bg-blue-100 text-blue-600 p-4 rounded-full">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </button>
                <p class="text-lg text-gray-600">Aucun utilisateur trouvé</p>
                <a href="{{ route('admin.users.create') }}" class="mt-2 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow-sm transition duration-200">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Créer un utilisateur
                </a>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>


  <!-- Pagination -->
  @if($users->hasPages())
    <div class="mt-6">
      {{ $users->withQueryString()->links('vendor.pagination.tailwind') }}
    </div>
  @endif

</div>
@endsection
