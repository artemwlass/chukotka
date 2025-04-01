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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->json('seo');
            $table->json('title');
            $table->json('slug');
            $table->string('main_image');
            $table->integer('tour_duration');
            $table->json('price');
            $table->json('tour_specifications');
            $table->json('title_1');
            $table->json('description');
            $table->string('image');
            $table->json('images');
            $table->text('link_video');
            $table->json('galleries');
            $table->json('program_capabilities');
            $table->json('awaits');
            $table->json('take');
            $table->json('first_small_block');
            $table->json('two_small_block');
            $table->json('three_small_block');
            $table->json('big_block');
            $table->text('map_link');
            $table->json('recommend');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
