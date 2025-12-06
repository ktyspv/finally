<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформить заказ</title>
    @vite(['resources/css/app.css'])
    <style>
        body {
            background-image: url('/images/background.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="relative">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="relative z-10 container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-white mb-6">Оформление заказа</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-6">{{ session('error') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Корзина -->
            <div class="bg-white bg-opacity-90 p-6 rounded">
                <h2 class="text-xl font-bold mb-4">Ваш заказ</h2>
                @foreach($cart as $item)
                    <div class="flex justify-between py-2 border-b">
                        <div>
                            <p>{{ $item['name'] }} (x{{ $item['quantity'] }})</p>
                        </div>
                        <p>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} ₽</p>
                    </div>
                @endforeach
                <div class="mt-4 text-xl font-bold">Итого: {{ number_format($total, 2, ',', ' ') }} ₽</div>
            </div>

            <!-- Форма -->
            <div class="bg-white bg-opacity-90 p-6 rounded">
                <form method="POST" action="{{ route('checkout.place') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block mb-2">Имя</label>
                        <input type="text" name="customer_name" required class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2">Email</label>
                        <input type="email" name="email" required class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-6">
                        <label class="block mb-2">Телефон (необязательно)</label>
                        <input type="text" name="phone" class="w-full p-2 border rounded">
                    </div>
                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
                        Оформить заказ
                    </button>
                    <a href="{{ route('cart.show') }}" class="text-blue-600 hover:underline block mt-4">
                        ← Вернуться в корзину
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
