<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $fillable = ['UserID', 'ItemID', 'Stars', 'Comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'UserID');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'ItemID');
    }
}
