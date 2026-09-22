<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un produit</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin-top: 6px; box-sizing: border-box; }
        .btn { display: inline-block; margin-top: 16px; padding: 10px 16px; background: #2e9f4d; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .btn-secondary { background: #6c757d; }
        .errors { color: #b00020; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Créer un produit</h1>

    @if($errors->any())
        <div class="errors">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>

        <label for="prix">Prix</label>
        <input type="number" id="prix" name="prix" step="0.01" value="{{ old('prix') }}" required>

        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" min="0" value="{{ old('stock') }}" required>

        <button type="submit" class="btn">Enregistrer</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</body>
</html>
