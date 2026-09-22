<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        .actions a, .actions form { display: inline-block; margin-right: 8px; }
        .btn { display: inline-block; padding: 8px 14px; border: none; border-radius: 4px; color: white; text-decoration: none; }
        .btn-primary { background: #2d6cdf; }
        .btn-success { background: #2e9f4d; }
        .btn-warning { background: #d08a1d; }
        .btn-danger { background: #d13a3a; }
        .alert { padding: 10px 15px; margin-bottom: 15px; border-radius: 4px; }
        .alert-success { background: #dff0d8; color: #3c763d; }
    </style>
</head>
<body>
    <h1>Produits</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-success">Créer un produit</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td>{{ $product['nom'] }}</td>
                    <td>{{ $product['description'] }}</td>
                    <td>{{ number_format($product['prix'], 2, '.', ' ') }} €</td>
                    <td>{{ $product['stock'] }}</td>
                    <td class="actions">
                        <a href="{{ route('products.show', $product['id']) }}" class="btn btn-primary">Voir</a>
                        <a href="{{ route('products.edit', $product['id']) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('products.destroy', $product['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Supprimer ce produit ?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Aucun produit trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
