<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('pending');
            $table->text('shipping_address')->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->timestamps();
        });
    
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->restrictOnDelete(); // 👈 histori aman
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // snapshot harga
            $table->timestamps();
    
            $table->unique(['order_id','product_id']); // opsional, cegah duplikasi item sama
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('order_items'); // 👈 drop anak dulu
        Schema::dropIfExists('orders');
    }
    
};
