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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('identity', 11)->nullable(false)->unique()->comment('CPF do cliente');
            $table->string('name', 50)->nullable(false);
            $table->dateTime('birthdate')->nullable(false);
            $table->enum('gender', ['male', 'female'])->nullable(false);
            $table->unsignedBigInteger('city_id')->nullable(false);
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
