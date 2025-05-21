@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-semibold mb-6">Mon profil</h2>

    {{-- Informations personnelles --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-lg font-medium mb-4">Informations personnelles</h3>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="name" class="block text-sm font-medium">Nom complet</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium">Adresse email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium">Téléphone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                </div>
            </div>

            <button type="submit"
                class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mettre à jour</button>
        </form>
    </div>

    {{-- Changer le mot de passe --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
        <h3 class="text-lg font-medium mb-4">Changer le mot de passe</h3>
        <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium">Mot de passe actuel</label>
                    <input type="password" name="current_password" id="current_password"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">Confirmer mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-700 dark:text-white shadow-sm">
                </div>
            </div>

            <button type="submit"
                class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Changer le mot de passe</button>
        </form>
    </div>
    @if(session('status'))
    <div
      x-data="{ show: true }"
      x-show="show"
      x-init="setTimeout(() => show = false, 4000)"
      class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-400 text-green-700 relative"
      role="alert"
    >
      <strong class="font-bold">Succès !</strong>
      <span class="block sm:inline">{{ session('status') }}</span>
      <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
        <svg class="fill-current h-6 w-6 text-green-700" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <title>Fermer</title>
          <path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.36 5.652a.5.5 0 1 0-.707.707L9.293 10l-3.64 3.64a.5.5 0 0 0 .707.707L10 10.707l3.64 3.64a.5.5 0 0 0 .707-.707L10.707 10l3.64-3.64a.5.5 0 0 0 0-.708z"/>
        </svg>
      </button>
    </div>
@endif


    {{-- Suppression de compte --}}
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h3 class="text-lg font-medium mb-4 text-red-600">Supprimer le compte</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Attention : Cette action est irréversible.</p>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Supprimer mon compte</button>
        </form>
    </div>
</div>
@endsection

