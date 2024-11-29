<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'UserID'          => '999',
            'email'           => 'guest@guest.com',
            'Phone_Number'    => '00000000',
            'First_Name'      => 'Guest',
            'Last_Name'       => 'User',
            'google_id'       => null,
            'password'        => null, 
            'address'         => null,
            'Points'          => 0,
            'avatar'          => null,
            'isAdmin'         => 0,
            'isActive'        => 1,
            'remember_token'  => null,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
        ]);
    }
}
