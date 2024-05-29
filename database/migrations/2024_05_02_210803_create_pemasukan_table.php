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
            $table->double('pemasukan');
            $table->date('tanggal');
            $table->enum('jenistransaksi', ['kontan', 'transfer']);
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
