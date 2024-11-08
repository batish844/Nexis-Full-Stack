<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $fillable = ['UserID', 'ItemID', 'Quantity', 'TotalPrice'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'ItemID');
    }
}
