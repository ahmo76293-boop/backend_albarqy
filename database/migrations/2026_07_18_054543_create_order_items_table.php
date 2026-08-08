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

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('unit_id')
                ->constrained()
                ->cascadeOnDelete();

            // Quantity ordered
            $table->integer('quantity');

            // Price of one unit at purchase time
            // Gift items will have price = 0
            $table->decimal('price', 12, 2);

            // quantity × price
            // Gift items will have total = 0
            $table->decimal('total', 12, 2);

            // Whether this item was added as a free gift
            $table->boolean('is_gift')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
