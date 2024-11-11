<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'ItemID';

    protected $fillable = [
        'Name',
        'Description',
        'Price',
        'Gender',
        'Size',
        'Quantity',
        'Points',
        'Photo',
        'isAvailable',
        'CategoryID',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items', 'ItemID', 'OrderID')->withPivot('Quantity', 'TotalPrice');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'ItemID');
    }

    public function cartUsers()
    {
        return $this->hasMany(Cart::class, 'ItemID');
    }

    public function wishlistUsers()
    {
        return $this->hasMany(Wishlist::class, 'ItemID');
    }
}