<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_xx_xx_create_reminders_table.php
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');

            // Status (Good/Bad)
            $table->string('sleep_status');
            $table->string('eat_status');
            $table->string('screen_time_status');

            // Messages
            $table->string('sleep_message');
            $table->string('eat_message');
            $table->string('screen_time_message');

            $table->date('date'); // Untuk menyimpan tanggal reminder dibuat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
