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
        Schema::create('items', function (Blueprint $table) {
            $table->id('ItemID');
            $table->foreignId('CategoryID')->constrained('categories', 'CategoryID');
            $table->string('Name');
            $table->text('Description')->nullable();
            $table->string('Gender');
            $table->decimal('Price', 8, 2);
            $table->string('Size');
            $table->integer('Quantity');
            $table->integer('Points')->default(0);
            $table->string('Photo')->nullable();
            $table->boolean('isAvailable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
