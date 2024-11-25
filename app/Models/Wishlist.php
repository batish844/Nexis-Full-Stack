<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist'; // Ensure this matches your database table name
    protected $fillable = ['UserID', 'ItemID', 'DateTime', 'is_read'];

    // public function item()
    // {
    //     return $this->belongsTo(Item::class, 'ItemID'); // Adjust foreign key if necessary
    // }
 

    public function item()
{
    return $this->belongsTo(Item::class, 'ItemID', 'ItemID'); // Match foreign key correctly
}

}