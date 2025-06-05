@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-md shadow-md mt-8">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Créer un nouveau ticket</h1>

    <form action="{{ route('support_tickets.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Sujet -->
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sujet :</label>
            <input
                type="text"
                name="subject"
                id="subject"
                value="{{ old('subject') }}"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
            >
            @error('subject')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description :</label>
            <textarea
                name="description"
                id="description"
                required
                rows="5"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 resize-none"
            >{{ old('description') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Priorité -->
        <div>
            <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Priorité :</label>
            <select
                name="priority"
                id="priority"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200"
            >
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Basse</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Haute</option>
            </select>
            @error('priority')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bouton envoyer -->
        <div>
            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition-colors duration-200"
            >
                Envoyer
            </button>
        </div>
    </form>
</div>
@endsection
