
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    

    public function up()
{
    Schema::create('wishlists', function (Blueprint $table) {
        
        $table->unsignedBigInteger('UserID');
        $table->unsignedBigInteger('ItemID');
        $table->timestamp('DateTime')->useCurrent();  // Save the time when the item is added
        $table->boolean('is_read')->default(false);  // Assuming a flag to mark read/unread status
        $table->timestamps();

        $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
        $table->foreign('ItemID')->references('ItemID')->on('items')->onDelete('cascade');
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