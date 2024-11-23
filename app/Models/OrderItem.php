<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = ['OrderID', 'ItemID', 'Quantity', 'Size', 'TotalPrice'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID', 'OrderID');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'ItemID', 'ItemID');
    }
}
