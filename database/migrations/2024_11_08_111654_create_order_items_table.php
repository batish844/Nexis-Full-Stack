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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('OrderID')->constrained('orders', 'OrderID')->onDelete('cascade');
            $table->foreignId('ItemID')->constrained('items', 'ItemID')->onDelete('cascade');
            $table->string('Size');
            $table->integer('Quantity');
            $table->decimal('TotalPrice', 8, 2)->nullable();
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
