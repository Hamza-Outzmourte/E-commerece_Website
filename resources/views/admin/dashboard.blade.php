<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-xl">
      <div class="p-6 text-center border-b">
        <img src="https://i.pravatar.cc/100" class="mx-auto w-20 h-20 rounded-full" alt="Avatar">
        <h2 class="mt-4 font-bold text-lg">Floyd Howard</h2>
      </div>
      <nav class="p-4 space-y-2">
        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-100"><span class="material-icons mr-2">dashboard</span> Dashboard</a>
        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-100">📊 Analytics</a>
        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-100">📅 Calendar</a>
        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-100">📦 Products</a>
        <a href="#" class="flex items-center p-2 rounded hover:bg-blue-100">📄 Invoices</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Topbar -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-blue-700">Dashboard</h1>
        <div class="flex items-center space-x-4">
          <button class="bg-white p-2 rounded-full shadow"><span class="material-icons">notifications</span></button>
          <img src="https://i.pravatar.cc/40" class="w-10 h-10 rounded-full" alt="User">
        </div>
      </div>

      <!-- Stat Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-xl shadow text-center">
          <p class="text-sm text-gray-500">Sales</p>
          <p class="text-2xl font-bold text-blue-600">3500</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow text-center">
          <p class="text-sm text-gray-500">Orders</p>
          <p class="text-2xl font-bold text-blue-600">2900</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow text-center">
          <p class="text-sm text-gray-500">Invoices</p>
          <p class="text-2xl font-bold text-blue-600">6500</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow text-center">
          <p class="text-sm text-gray-500">Alerts</p>
          <p class="text-2xl font-bold text-blue-600">7200</p>
        </div>
      </div>

      <!-- Charts -->
      <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-bold mb-4">Revenue</h2>
        <canvas id="revenueChart" height="100"></canvas>
      </div>
    </main>
  </div>

  <script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        datasets: [{
          label: 'Revenue',
          data: [100, 200, 300, 250, 400],
          backgroundColor: '#3B82F6'
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html
