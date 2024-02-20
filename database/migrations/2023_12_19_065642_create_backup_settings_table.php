<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('backup_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['daily', 'weekly', 'monthly']);
            $table->integer('day_of_week')->nullable();
            $table->integer('day_of_month')->nullable();
            $table->string('time_of_day');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_settings');
    }
};
