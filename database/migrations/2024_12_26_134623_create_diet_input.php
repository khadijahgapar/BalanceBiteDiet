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
        Schema::create('diet_input', function (Blueprint $table) {
            $table->id();
            $table->float('weight');
            $table->float('height');
            $table->unsignedBigInteger('activity_level_id');
            $table->string('dietary_preference');
            $table->string('medical_condition')->nullable();
            $table->string('goal');
            $table->enum('category_food_set', ['Casual', 'Moderate', 'Intensive']);
            $table->json('set_food');
            $table->integer('calories');
            $table->timestamps();

            $table->foreign('activity_level_id')->references('id')->on('activity_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_input');
    }
};
