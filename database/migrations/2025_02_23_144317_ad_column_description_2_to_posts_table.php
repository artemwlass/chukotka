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
        Schema::table('posts', function (Blueprint $table) {
            $table->json('description_2')->nullable();
            $table->foreignId('recommendation_tour_id')->nullable()->constrained('tours')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('description_2');
            $table->dropForeign('posts_recommendation_tour_id_foreign');
            $table->dropColumn('recommendation_tour_id');
        });
    }
};
