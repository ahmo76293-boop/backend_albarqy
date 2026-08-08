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
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('order_number')->unique();

            $table->decimal('subtotal', 12, 2)->default(0);

            $table->decimal('delivery_fee', 12, 2)->default(0);

            $table->decimal('discount', 12, 2)->default(0);

            $table->foreignId('coupon_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->decimal('coupon_discount', 12, 2)
                ->default(0);

            $table->decimal('total', 12, 2);

            $table->enum('payment_method', [
                'cash',
                'card'
            ]);

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed'
            ])->default('pending');

            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'shipped',
                'delivered',
                'cancelled'
            ])->default('pending');

            $table->foreignId('location_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('notes')->nullable();

            $table->foreignId('delivery_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

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
