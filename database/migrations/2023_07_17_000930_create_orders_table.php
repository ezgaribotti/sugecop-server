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
            $table->string('order_number')->unique();
            $table->foreignId('order_status_id')->constrained('order_statuses');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('identification_id')->constrained('identifications');
            $table->foreignId('shipping_address_id')->constrained('addresses');
            $table->double('total_amount', 11, 2)->default(0);
            $table->text('observation')->nullable();
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
