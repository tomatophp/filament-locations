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
        if (! Schema::hasTable('locations')) {
            Schema::create('locations', function (Blueprint $table) {
                $table->id();

                //Link To Table
                $table->string('model_type')->nullable();
                $table->string('model_id')->nullable();

                $table->string('street');
                $table->unsignedBigInteger('area_id')->nullable();
                $table->unsignedBigInteger('city_id')->nullable();
                $table->unsignedBigInteger('country_id')->nullable();
                $table->unsignedInteger('home_number')->nullable();
                $table->unsignedInteger('flat_number')->nullable();
                $table->unsignedInteger('floor_number')->nullable();
                $table->string('mark')->nullable();
                $table->text('map_url')->nullable();
                $table->string('note')->nullable();
                $table->string('lat')->nullable();
                $table->string('lng')->nullable();
                $table->string('zip')->nullable();
                $table->boolean('is_main')->default(0)->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
