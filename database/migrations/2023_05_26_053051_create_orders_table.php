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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('code')->unique();
            $table->string('payment_method');
            $table->string('payment_status');
            $table->text('note');
            $table->decimal('total_price');
            $table->timestamps();
            $table->string('status');
            $table->string('name', 255);
            $table->string('phoneNumber', 255);
            $table->string('address', 255);
            $table->string('email');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
