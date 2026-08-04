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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique();

            $table->enum('type', [
                'fixed',
                'percentage',
            ]);

            $table->decimal('value', 10, 2);

            $table->decimal('minimum_order_amount', 10, 2)
                ->default(0);

            $table->unsignedInteger('usage_limit')
                ->nullable();

            $table->unsignedInteger('used_count')
                ->default(0);

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
        Schema::dropIfExists('coupons');
    }
};
