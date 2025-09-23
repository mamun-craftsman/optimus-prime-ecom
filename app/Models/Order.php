<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'full_name',
        'email',
        'phone',
        'address',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'payment_method',
        'payment_status',
        'order_status',
        'transaction_id'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => '<span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>',
            'processing' => '<span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Processing</span>',
            'shipped' => '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Shipped</span>',
            'delivered' => '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Delivered</span>',
            'cancelled' => '<span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">Cancelled</span>',
        ];

        return $badges[$this->order_status] ?? '<span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Unknown</span>';
    }
}
