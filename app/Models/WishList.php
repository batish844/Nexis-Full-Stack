<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wish_list';
    protected $fillable = ['UserID', 'ItemID', 'DateTime'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'ItemID');
    }
}
