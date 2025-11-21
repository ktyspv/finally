<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить товар</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Добавить новый товар</h1>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Название</label>
                <input type="text" name="name" required
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Описание (необязательно)</label>
                <textarea name="description" rows="4"
                          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Цена (₽)</label>
                <input type="number" name="price" step="0.01" min="0" required
                       class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Изображение (необязательно)</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-3 py-2 border rounded">
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Сохранить товар
                </button>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                    Отмена
                </a>
            </div>
        </form>
    </div>
</body>
</html>
