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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            $table->json('seo');
            $table->json('title');
            $table->string('image');
            $table->json('title_2');
            $table->json('first_block');
            $table->json('two_block');
            $table->json('three_block');
            $table->json('four_block');
            $table->json('description');
            $table->string('big_image');
            $table->string('small_image');
            $table->json('partner');
            $table->json('card_organization');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
