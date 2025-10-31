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
            $table->foreignId('maker_id')->constrained("makers");
            $table->foreignId('model_id')->constrained("models");
            $table->integer("year");
            $table->integer("price");
            $table->string("vin", 225);
            $table->integer("mileage");
            $table->foreignId("car_type_id")->constrained("car_types");
            $table->foreignId("car_fuel_id")->constrained("car_fuels");
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("city_id")->constrained("cities");
            $table->string("address", 255);
            $table->string("phone", 45);
            $table->longText("description")->nullable();
            $table->timestamps();
            $table->timestamp("published_at")->nullable();
            $table->timestamp("deleted_at")->nullable();
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
