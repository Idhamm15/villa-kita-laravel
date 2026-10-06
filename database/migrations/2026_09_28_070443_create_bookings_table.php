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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code', 255)->unique();
            $table->string('order_id')->nullable();
            $table->string('product_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('name_guest')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('check_in')->nullable();
            $table->string('check_out')->nullable();
            $table->string('total_guest')->nullable();
            $table->string('discount')->nullable();
            $table->string('total_price')->nullable();

            $table->string('status')->nullable();
            $table->string('visitor_type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_token')->nullable();
            $table->string('payment_url')->nullable();

            $table->dateTime('paid_at')->nullable();
            $table->dateTime('expired_at')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
