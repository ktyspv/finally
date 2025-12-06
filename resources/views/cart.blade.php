<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
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
        <nav class="bg-blue-600 text-white p-4">
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
            <h1 class="text-3xl font-bold mb-8 text-white drop-shadow">🛒 Ваша корзина</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(count($cart) > 0)
                <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded shadow overflow-hidden">
                    @foreach($cart as $id => $item)
                        <div class="flex items-center border-b p-4">
                            @if($item['image_path'])
                                <img src="{{ asset('images/' . $item['image_path']) }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-16 h-16 object-cover rounded mr-4">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded mr-4 flex items-center justify-center">
                                    <span class="text-xs text-gray-500">Нет фото</span>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h2 class="font-semibold">{{ $item['name'] }}</h2>
                                <p class="text-gray-600">Кол-во: {{ $item['quantity'] }}</p>
                                <p class="text-lg font-bold text-green-600">
                                    {{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} ₽
                                </p>
                            </div>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="ml-4">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                    Удалить
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 text-right">
                    <p class="text-2xl font-bold text-white drop-shadow">Итого: {{ number_format($total, 2, ',', ' ') }} ₽</p>
                    <a href="{{ route('checkout.show') }}" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Оформить заказ
                    </a>
                    <a href="/" class="mt-4 inline-block bg-amber-600 text-white px-4 py-2 rounded hover:bg-amber-700">
                        Продолжить покупки
                    </a>
                    <!-- Сюда позже можно добавить "Оформить заказ" -->
                </div>
            @else
                <div class="bg-white bg-opacity-90 backdrop-blur-sm rounded p-8 text-center">
                    <p class="text-gray-600">Ваша корзина пуста.</p>
                    <div class="mt-4">
                        <a href="/" class="text-blue-600 hover:underline font-medium">← Вернуться в магазин</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
