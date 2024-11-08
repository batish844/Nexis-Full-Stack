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
        Schema::create('includes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('OrderID')->constrained('orders', 'OrderID');
            $table->foreignId('ItemID')->constrained('items', 'ItemID');
            $table->integer('Quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('includes');
    }
};
