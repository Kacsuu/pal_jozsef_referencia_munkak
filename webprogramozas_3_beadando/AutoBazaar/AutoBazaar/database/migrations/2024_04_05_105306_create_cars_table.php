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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->string('type');
            $table->foreignId('model_id')->references('id')->on('models');
            $table->foreignId('condition_id')->references('id')->on('conditions');
            $table->integer('year');
            $table->integer('odometer');
            $table->string('engine');
            $table->foreignId('fuel_id')->references('id')->on('fuels');
            $table->integer('cylindercapacity');
            $table->integer('horsepower');
            $table->foreignId('transmission_id')->references('id')->on('transmissions');
            $table->binary('picture');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
