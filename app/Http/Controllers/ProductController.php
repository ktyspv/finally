<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Главная страница — список товаров
    public function index()
{
    $categories = \App\Models\Category::with('products')->get();
    return view('products.index', compact('categories'));
}

    // Админка: список товаров
    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Форма добавления товара
    public function create()
{
    $categories = \App\Models\Category::all();
    return view('admin.products.create', compact('categories'));
}

    // Сохранение товара + загрузка изображения
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // до 2 МБ
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::slug($request->name) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $filename);
            $imagePath = $filename;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно добавлен!');
    }
    public function addToCart(Request $request, Product $product)
{
    $cart = session()->get('cart', []);

    // Если товар уже в корзине — увеличим количество
    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            "name" => $product->name,
            "description" => $product->description,
            "price" => $product->price,
            "image_path" => $product->image_path,
            "quantity" => 1
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Товар добавлен в корзину!');
}
public function showCart()
{
    $cart = session()->get('cart', []);
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return view('cart', compact('cart', 'total'));
}
public function removeFromCart(Request $request, $productId)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    return back()->with('success', 'Товар удалён из корзины.');
}
}
