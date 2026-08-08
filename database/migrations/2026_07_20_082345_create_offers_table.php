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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            // Offer information
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();

            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();

            $table->string('image')->nullable();

            // Discount type
            $table->enum('type', [
                'fixed',
                'percentage',
                'gift',
            ]);

            // Used for fixed / percentage
            $table->decimal('value', 10, 2)->nullable();

            // Used for gift offers
            $table->unsignedInteger('buy_quantity')->nullable();

            $table->foreignId('gift_product_unit_id')
                ->nullable()
                ->constrained('product_unit')
                ->nullOnDelete();

            $table->unsignedInteger('gift_quantity')->nullable();

            // Dates
            $table->date('start_date');
            $table->date('end_date');

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
