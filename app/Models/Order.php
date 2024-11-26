<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'OrderID';

    protected $fillable = [
        'OrderedBy',
        'TotalPrice',
        'guest_email',
        'guest_address',
        'is_guest',
        'Status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'OrderedBy', 'UserID');
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'order_items', 'OrderID', 'ItemID')->withPivot('Quantity', 'TotalPrice');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'OrderID', 'OrderID');
    }
}
