<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин для животных</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            background-image: url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="relative">
    <div class="absolute inset-0 bg-black bg-opacity-20 z-0"></div>
    <div class="relative z-10">
        <!-- Шапка -->
        <nav class="bg-amber-900 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="/" class="text-xl font-bold">🐾 Магазин для животных</a>
                <a href="{{ route('cart.show') }}" class="hover:underline flex items-center">
                    🛒 Корзина
                    @if(session()->has('cart'))
                        <span class="ml-1 bg-white text-blue-600 rounded-full w-5 h-5 flex items-center justify-center text-xs">
                            {{ collect(session()->get('cart'))->sum('quantity') }}
                        </span>
                    @endif
                </a>
            </div>
        </nav>

        <!-- Основной контент -->
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-white drop-shadow">🐾 Товары для ваших питомцев</h1>

            @foreach($categories as $category)
                @if($category->products->isNotEmpty())
                    <h2 class="text-2xl font-bold mt-12 mb-6 text-white drop-shadow">{{ $category->name }}</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($category->products as $product)
                            <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded-lg shadow-md p-4">
                                @if($product->image_path)
                                    <img src="{{ asset('images/' . $product->image_path) }}"
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
                                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="w-full bg-amber-900 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                        В корзину
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach

            @if($categories->flatMap->products->isEmpty())
                <p class="text-center col-span-full text-white drop-shadow mt-12">Нет товаров.</p>
            @endif
        </div>
    </div>
</body>
</html>
