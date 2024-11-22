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
        Schema::create('wishlist', function (Blueprint $table) {
            $table->foreignId('UserID')->constrained('users', 'UserID')->onDelete('cascade');
            $table->foreignId('ItemID')->constrained('items', 'ItemID')->onDelete('cascade');
            $table->dateTime('DateTime');
            $table->boolean('is_read')->default(false);
            $table->primary(['UserID', 'ItemID']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist');
    }
};
