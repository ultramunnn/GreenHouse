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
        Schema::create('transaksi_sensor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('masterdevice_id')->constrained('masterdevice')->onDelete('cascade');
            $table->double('nilai', 15, 4); // contoh tipe float/double untuk sensor value
            $table->timestamps();
            $table->timestamp('waktu_pencatatan')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_sensor');
    }
};
