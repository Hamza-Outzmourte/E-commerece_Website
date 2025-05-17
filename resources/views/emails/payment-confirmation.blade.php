<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de Paiement</title>
</head>
<body>
    <h2>Merci pour votre commande !</h2>
    <p>Bonjour {{ $order->user->name }},</p>

    <p>Nous avons bien reçu votre paiement. Voici les détails :</p>

    <ul>
        <li><strong>Commande #:</strong> {{ $order->id }}</li>
        <li><strong>Montant:</strong> {{ $order->total }} €</li>
        <li><strong>Date:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</li>
    </ul>

    <p>Vous recevrez une notification dès que votre commande sera expédiée.</p>

    <p>Merci de faire confiance à E-Shop.</p>
</body>
</html>
