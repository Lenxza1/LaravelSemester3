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
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idProduk');
            $table->integer('amount');
            $table->enum('status', ['pending', 'success', 'cancel'])->default('pending');
            $table->timestamps();
            $table->foreign('idUser')->references('id')->on('users')->noActionOnDelete();
            $table->foreign('idProduk')->references('id')->on('products')->noActionOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
