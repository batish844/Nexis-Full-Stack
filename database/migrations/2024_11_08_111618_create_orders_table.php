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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('OrderID');
            $table->string('Status');
            $table->decimal('TotalPrice', 8, 2)->nullable();
            $table->foreignId('OrderedBy')->constrained('users', 'UserID')->onDelete('cascade');
            $table->string('guest_email')->nullable();
            $table->json('guest_address')->nullable();
            $table->boolean('is_guest')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
