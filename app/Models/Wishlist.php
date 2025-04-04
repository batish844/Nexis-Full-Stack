<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlists';
    protected $fillable = ['UserID', 'ItemID'];

   public function item()
{
    return $this->belongsTo(Item::class, 'ItemID', 'ItemID');
}

}