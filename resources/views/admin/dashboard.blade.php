<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Carte d’accueil --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl p-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Bienvenue, Admin !</h3>
                <p class="text-gray-700 dark:text-gray-300">Voici un aperçu rapide de votre tableau de bord.</p>
            </div>

            {{-- Exemple de section statistiques --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h4 class="text-lg font-semibold mb-2">Utilisateurs</h4>
                    <p class="text-3xl font-bold text-blue-600">1250</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h4 class="text-lg font-semibold mb-2">Commandes</h4>
                    <p class="text-3xl font-bold text-green-600">320</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h4 class="text-lg font-semibold mb-2">Revenus</h4>
                    <p class="text-3xl font-bold text-purple-600">42 000 Dh</p>
                </div>
            </div>

            {{-- Autres contenus... --}}

        </div>
    </div>
</x-app-layout>
