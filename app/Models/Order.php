<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Поля, разрешённые для массового присваивания.
     */
    protected $fillable = ['customer_name', 'email', 'phone', 'items', 'total'];

    /**
     * Автоматическое преобразование поля `items` в массив при получении
     * и в JSON при сохранении.
     */
    protected $casts = [
        'items' => 'array',
    ];
}
