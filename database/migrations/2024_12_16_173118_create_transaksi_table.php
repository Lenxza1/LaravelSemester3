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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPetugas');
            $table->unsignedBigInteger('idOrder');
            $table->integer('total');
            // $table->enum('status', ['pending', 'success', 'cancel']);
            $table->timestamps();
            $table->foreign('idPetugas')->references('id')->on('users')->noActionOnDelete()->noActionOnUpdate();
            $table->foreign('idOrder')->references('id')->on('orders')->noActionOnDelete()->noActionOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
