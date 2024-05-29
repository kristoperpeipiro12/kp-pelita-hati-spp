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
        Schema::create('konfirmasipembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nis');
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->double('pemasukan');
            $table->date('tanggal');
            $table->enum('jenis_transaksi',['kontan','transfer']);
            $table->string('foto');
            $table->tinyInteger('konfirmasi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfirmasipembayaran');
    }
};
