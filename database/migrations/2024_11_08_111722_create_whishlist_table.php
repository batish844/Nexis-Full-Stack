<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('whishlist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserID')->constrained('users', 'UserID');
            $table->foreignId('ItemID')->constrained('items', 'ItemID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('whishlist');
    }
};
