@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="min-h-screen flex bg-gray-50 dark:bg-gray-900">

  <!-- Sidebar -->
  <aside class="w-64 bg-white dark:bg-gray-800 shadow-md p-6 flex flex-col">
    <h1 class="text-2xl font-bold mb-8 text-blue-700 dark:text-white">Admin Panel</h1>
    <nav class="flex flex-col space-y-4 text-gray-700 dark:text-gray-200 font-medium">
      <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-500 transition">Dashboard</a>
      <a href="{{ route('admin.products.index') }}" class="hover:text-blue-500 transition">Produits</a>
      <a href="{{ route('admin.orders.index') }}" class="hover:text-blue-500 transition">Commandes</a>
      <a href="{{ route('notifications.index') }}" class="hover:text-blue-500 transition">Notifications</a>
      <a href="{{ route('admin.stock.index') }}" class="hover:text-blue-500 transition">Gestion du stock</a>
      <a href="{{ route('admin.reviews.index') }}" class="hover:text-blue-500 transition">Avis</a>
    </nav>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-8 overflow-auto">

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Produits</h3>
        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $productCount ?? 0 }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Commandes</h3>
        <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $orderCount ?? 0 }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Utilisateurs</h3>
        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $userCount ?? 0 }}</p>
      </div>
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow text-center">
        <h3 class="text-sm text-gray-500 dark:text-gray-400">Revenus (mois)</h3>
        <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">MAD {{ number_format($monthlyRevenue ?? 0, 2, ',', ' ') }}</p>
      </div>
    </div>

    <!-- Graphiques -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Commandes par mois</h2>
        <canvas id="ordersChart" class="w-full h-64"></canvas>
      </div>
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Revenu par mois</h2>
        <canvas id="revenueChart" class="w-full h-64"></canvas>
      </div>
    </div>

    <!-- Produits récents -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-8">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Produits récents</h2>
        <a href="{{ route('admin.products.index') }}" class="text-sm text-blue-600 hover:underline">Voir tout</a>
      </div>
      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($recentProducts ?? [] as $product)
          <li class="py-3 flex justify-between items-center">
            <span class="text-gray-700 dark:text-gray-200">{{ $product->name }}</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">Stock : {{ $product->stock }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Commandes récentes -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow mb-8">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Commandes récentes</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:underline">Voir tout</a>
      </div>
      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($recentOrders ?? [] as $order)
          <li class="py-3 flex justify-between items-center">
            <span class="text-gray-700 dark:text-gray-200">Commande #{{ $order->id }} par {{ $order->user->name ?? 'Utilisateur' }}</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">Total : MAD {{ number_format($order->total, 2, ',', ' ') }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Avis récents -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Avis récents</h2>
        <a href="{{ route('admin.reviews.index') }}" class="text-sm text-blue-600 hover:underline">Gérer</a>
      </div>
      <ul class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($recentReviews ?? [] as $review)
          <li class="py-3">
            <div class="flex justify-between items-center">
              <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $review->user->name ?? 'Utilisateur inconnu' }}</span>
              <span class="text-yellow-500 text-sm">
                {!! str_repeat('★', $review->rating) . str_repeat('☆', 5 - $review->rating) !!}
              </span>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $review->comment ?? '' }}</p>
          </li>
        @endforeach
      </ul>
    </div>

  </main>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const labels = {!! json_encode($labels ?? []) !!};
  const orderValues = {!! json_encode($values ?? []) !!};
  const revenueValues = {!! json_encode($revenueValues ?? []) !!};

  const ordersChart = document.getElementById('ordersChart');
  const revenueChart = document.getElementById('revenueChart');

  if (ordersChart) {
    new Chart(ordersChart, {
      type: 'bar',
      data: {
        labels,
        datasets: [{
          label: 'Commandes',
          data: orderValues,
          backgroundColor: 'rgba(59, 130, 246, 0.7)',
          borderColor: 'rgba(59, 130, 246, 1)',
          borderWidth: 1,
          borderRadius: 4
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
      }
    });
  }

  if (revenueChart) {
    new Chart(revenueChart, {
      type: 'line',
      data: {
        labels,
        datasets: [{
          label: 'Revenu (MAD)',
          data: revenueValues,
          borderColor: 'rgba(16, 185, 129, 1)',
          backgroundColor: 'rgba(16, 185, 129, 0.2)',
          fill: true,
          tension: 0.3,
          pointRadius: 4,
          pointHoverRadius: 6
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: ctx => `${ctx.dataset.label}: ${ctx.parsed.y.toFixed(2)} MAD`
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { callback: value => `${value} MAD` }
          }
        }
      }
    });
  }
</script>
@endsection
