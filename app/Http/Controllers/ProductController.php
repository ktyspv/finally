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
        $products = Product::all();
        return view('products.index', compact('products'));
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
        return view('admin.products.create');
    }

    // Сохранение товара + загрузка изображения
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
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
}
