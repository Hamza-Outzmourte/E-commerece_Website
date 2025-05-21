@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-4">Contactez-nous</h1>

    <div class="mb-6 bg-white p-4 rounded shadow">
        <p><strong>À propos du site :</strong> E-Shop, votre boutique en ligne de confiance.</p>
        <p><strong>Téléphone :</strong> +212 600 000 000</p>
        <p><strong>Email :</strong> contact@eshop.com</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('contact.send') }}" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">Votre email</label>
            <input type="email" name="email" class="mt-1 block w-full border border-gray-300 rounded p-2" required>
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Votre message</label>
            <textarea name="message" rows="5" class="mt-1 block w-full border border-gray-300 rounded p-2 text-gray-900 bg-white" required></textarea>
            @error('message') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
    </form>
</div>
@endsection