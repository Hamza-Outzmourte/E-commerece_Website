<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid #ccc; }
        .table th, .table td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>Facture #{{ $order->id }}</h1>
    <p><strong>Date :</strong> {{ $order->created_at->format('d/m/Y') }}</p>
    <p><strong>Client :</strong> {{ $order->user->name }} ({{ $order->user->email }})</p>

    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="margin-top: 20px;">Total : {{ number_format($order->total, 2) }} €</h3>
</body>
</html>
