<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин для животных</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-8">🐾 Товары для ваших питомцев</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-md p-4">
                    @if($product->image_path)
                        <img src="{{ asset('storage/images/' . $product->image_path) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-48 object-cover rounded mb-4">
                    @else
                        <div class="w-full h-48 bg-gray-200 rounded mb-4 flex items-center justify-center">
                            <span class="text-gray-500">Нет фото</span>
                        </div>
                    @endif
                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-gray-600 mt-2">{{ Str::limit($product->description, 100) }}</p>
                    <p class="text-lg font-bold text-green-600 mt-2">{{ number_format($product->price, 2, ',', ' ') }} ₽</p>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        В корзину
                    </button>
                </div>
            @empty
                <p class="text-center col-span-full">Нет товаров.</p>
            @endforelse
        </div>
    </div>
</body>
</html>
