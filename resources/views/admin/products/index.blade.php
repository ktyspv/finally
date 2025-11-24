<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админка — Товары</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Админка: Товары</h1>
            <a href="{{ route('admin.products.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Новый товар
            </a>
            <a href="{{ route('admin.orders') }}"
           class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            Заказы
        </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($products->isEmpty())
            <p>Нет товаров.</p>
        @else
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left">Изображение</th>
                            <th class="px-4 py-2 text-left">Название</th>
                            <th class="px-4 py-2 text-left">Категория</th>
                            <th class="px-4 py-2 text-left">Цена</th>
                            <th class="px-4 py-2 text-left">Действия</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($products as $product)
                            <tr>
                                <td class="px-4 py-2">
                                    @if($product->image_path)
                                        <img src="{{ asset('images/' . $product->image_path) }}"
                                             alt="Фото" class="w-12 h-12 object-cover rounded">
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->category?->name ?? 'Без категории' }}</td>
                                <td class="px-4 py-2">{{ number_format($product->price, 2, ',', ' ') }} ₽</td>
                                <td class="px-4 py-2">
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium"
                                                onclick="return confirm('Удалить товар?')">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-6">
            <a href="/" class="text-blue-600 hover:underline">&larr; Вернуться на сайт</a>
        </div>
    </div>
</body>
</html>
