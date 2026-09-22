<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    private function products(): array
    {
        return Session::get('products', [
            [
                'id' => 14,
                'nom' => 'Mitsubishi',
                'description' => 'Autre produit sur le marché.',
                'prix' => 449.30,
                'stock' => 30,
            ],
            [
                'id' => 15,
                'nom' => 'Dell XPS',
                'description' => 'Ordinateur portable professionnel.',
                'prix' => 1299.99,
                'stock' => 12,
            ],
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->products();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $products = $this->products();
        $nextId = 1;

        if (!empty($products)) {
            $nextId = max(array_column($products, 'id')) + 1;
        }

        $products[] = [
            'id' => $nextId,
            'nom' => $validated['nom'],
            'description' => $validated['description'],
            'prix' => (float) $validated['prix'],
            'stock' => (int) $validated['stock'],
        ];

        Session::put('products', $products);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->findProduct($id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->findProduct($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'stock' => 'required|integer|min:0',
        ]);

        $products = $this->products();
        $index = $this->findProductIndex($id, $products);

        if ($index === null) {
            abort(404);
        }

        $products[$index]['nom'] = $validated['nom'];
        $products[$index]['description'] = $validated['description'];
        $products[$index]['prix'] = (float) $validated['prix'];
        $products[$index]['stock'] = (int) $validated['stock'];

        Session::put('products', $products);

        return redirect()->route('products.show', $id)->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = $this->products();
        $products = array_values(array_filter($products, fn (array $product) => (int) $product['id'] !== (int) $id));

        Session::put('products', $products);

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }

    private function findProduct(string $id): array
    {
        $products = $this->products();
        $product = collect($products)->firstWhere('id', (int) $id);

        abort_if($product === null, 404);

        return $product->toArray();
    }

    private function findProductIndex(string $id, array $products): ?int
    {
        foreach ($products as $index => $product) {
            if ((int) $product['id'] === (int) $id) {
                return $index;
            }
        }

        return null;
    }
}
