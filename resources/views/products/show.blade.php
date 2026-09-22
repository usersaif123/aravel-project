<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['nom'] }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .card { max-width: 600px; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        .btn { display: inline-block; margin-right: 10px; padding: 10px 16px; color: white; text-decoration: none; border-radius: 4px; }
        .btn-primary { background: #2d6cdf; }
        .btn-warning { background: #d08a1d; }
        .btn-danger { background: #d13a3a; }
        .alert { padding: 10px 15px; margin-bottom: 15px; border-radius: 4px; background: #dff0d8; color: #3c763d; }
    </style>
</head>
<body>
    <h1>Détail du produit</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <div class="card">
        <p><strong>ID:</strong> {{ $product['id'] }}</p>
        <p><strong>Nom:</strong> {{ $product['nom'] }}</p>
        <p><strong>Description:</strong> {{ $product['description'] }}</p>
        <p><strong>Prix:</strong> {{ number_format($product['prix'], 2, '.', ' ') }} €</p>
        <p><strong>Stock:</strong> {{ $product['stock'] }}</p>

        <a href="{{ route('products.index') }}" class="btn btn-primary">Retour</a>
        <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-warning">Modifier</a>
        <form action="{{ route('products.destroy', $product['id']) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce produit ?')">Delete</button>
        </form>
    </div>
</body>
</html>
