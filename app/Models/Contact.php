<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $primaryKey = 'ContactID';

    protected $fillable = [
        'DateTime',
        'Message',
        'Email',
        'Full_Name',
        'ContactedBy'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ContactedBy');
    }
}
