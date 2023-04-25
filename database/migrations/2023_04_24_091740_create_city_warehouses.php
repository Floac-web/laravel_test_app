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
        Schema::create('city_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('city_ref');
            $table->foreign('city_ref')->references('ref')
            ->on('cities')
            ->onDelete('cascade');
            $table->string('address');
            $table->integer('number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_warehouses');
    }
};
