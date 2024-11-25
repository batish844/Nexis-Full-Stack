<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'CartID'; 
    protected $fillable = ['UserID', 'ItemID', 'Quantity','Size'];


    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'ItemID', 'ItemID');
    }
}
