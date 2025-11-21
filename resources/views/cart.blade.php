<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">🛒 Ваша корзина</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="bg-white rounded shadow overflow-hidden">
                @foreach($cart as $id => $item)
                    <div class="flex items-center border-b p-4">
                        @if($item['image_path'])
                            <img src="{{ asset('storage/images/' . $item['image_path']) }}" 
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
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-right">
                <p class="text-2xl font-bold">Итого: {{ number_format($total, 2, ',', ' ') }} ₽</p>
                <a href="/" class="mt-4 inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Продолжить покупки
                </a>
                <!-- Позже сюда можно добавить "Оформить заказ" -->
            </div>
        @else
            <p class="text-center text-gray-600">Ваша корзина пуста.</p>
            <div class="text-center mt-4">
                <a href="/" class="text-blue-600 hover:underline">← Вернуться в магазин</a>
            </div>
        @endif
    </div>
</body>
</html>
