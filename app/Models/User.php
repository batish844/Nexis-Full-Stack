<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'UserID';
    protected $fillable = [
        'First_Name',
        'Last_Name',
        'email',
        'Phone_Number',
        'password',
        'Points',
        'avatar',
        'isAdmin',
        'Address',
        'google_id',
    ];
    protected $casts = [
        'Address' => 'array',
    ];
    public function sendPasswordResetNotification($token)
    {
        $resetUrl = url('/reset-password/' . $token) . '?email=' . urlencode($this->email);
        $userName = trim($this->First_Name . ' ' . $this->Last_Name) ?: 'Valued Customer';

        Mail::to($this->email)->send(new \App\Mail\ResetPasswordMail($resetUrl, $userName, $this->email));
    }




    public function orders()
    {
        return $this->hasMany(Order::class, 'OrderedBy', 'UserID');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'ContactedBy');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'UserID');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'UserID', 'UserID');
    }


    public function wishlist()
{
    return $this->hasMany(Wishlist::class, 'UserID');
}



//     public function wishlistItems()
//     {
//         return $this->hasMany(Wishlist::class, 'UserID');
//     }
//    // User.php (Model)
// public function wishlist()
// {
//     return $this->belongsToMany(Item::class, 'wishlist', 'UserID', 'ItemID')
//                 ->withTimestamps();  // Ensure timestamps are stored in the pivot table
// }


    // In User.php model

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
