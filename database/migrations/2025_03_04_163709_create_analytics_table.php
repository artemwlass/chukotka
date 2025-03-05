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
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 45)->nullable(); // IP-адрес пользователя
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->text('user_agent')->nullable(); // User-Agent браузера
            $table->string('url', 255)->nullable(); // URL посещенной страницы
            $table->string('referrer', 255)->nullable(); // Источник перехода (реферер)
            $table->string('device', 10)->nullable(); // Тип устройства (desktop, mobile, tablet)
            $table->string('platform', 50)->nullable(); // ОС (Windows, MacOS, Android, iOS)
            $table->string('browser', 50)->nullable(); // Браузер (Chrome, Firefox, Safari)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
