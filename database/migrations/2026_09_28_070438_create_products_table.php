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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('thumbnail')->nullable();
            $table->enum('type', ['VILLA', 'TRIP'])->default('VILLA');
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('url_maps')->nullable();
            $table->enum('booking_type', ['MENGINAP', 'HARIAN'])->default('MENGINAP');
            $table->string('service_fee')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('created_by');
            $table->integer('total_bedroom')->nullable();
            $table->integer('total_bathroom')->nullable();
            $table->integer('max_guest')->nullable();
            $table->integer('wide')->nullable();

            $table->integer('price_start')->nullable();
            $table->integer('price')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();

            $table->string('type_unit')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->enum('type', ['FACILITY', 'INCLUDE', 'EXCLUDE'])->nullable();
            $table->string('name')->nullable();
            $table->integer('sort')->nullable();

            $table->timestamps();
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('image')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
