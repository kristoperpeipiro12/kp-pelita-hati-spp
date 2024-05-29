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
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nis')->unsigned()->digits(8);
            $table->foreign('nis')->references('nis')->on('siswas')->onDelete('cascade');
            $table->string('bulan_tagihan')->digits(2);
            $table->string('tahun_tagihan')->digits(4);
            $table->double('jumlah_bayar');
            $table->date('tanggal_bayar');
            $table->enum('jenis_transaksi', ['Kontan', 'Transfer']);
            $table->enum('konfirmasi', ['Terima', 'Tolak', 'Pending'])->default('Pending');
            $table->string('foto')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }

};