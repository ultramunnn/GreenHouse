<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('masterdevice', function (Blueprint $table) {
            $table->dropColumn('jenis_device');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masterdevice', function (Blueprint $table) {
            $table->string('jenis_device')->nullable();
        });
    }
};
