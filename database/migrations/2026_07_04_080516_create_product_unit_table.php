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
        Schema::create('product_unit', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('unit_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('quantity');

            $table->decimal('price');

            $table->timestamps();

            $table->unique([
                'product_id',
                'unit_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_unit');
    }
};
