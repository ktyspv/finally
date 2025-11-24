<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История заказов — Админка</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">История заказов</h1>
            <a href="{{ route('admin.products.index') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ← Назад к товарам
            </a>
        </div>

        @if($orders->isEmpty())
            <p class="text-gray-600">Заказов пока нет.</p>
        @else
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя клиента</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Телефон</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Сумма</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $order->id }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $order->customer_name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $order->email }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $order->phone ?? '—' }}</td>
                                <td class="px-4 py-3 whitespace-nowrap font-medium">
                                    {{ number_format($order->total, 2, ',', ' ') }} ₽
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ $order->created_at->format('d.m.Y H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
