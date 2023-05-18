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
        Schema::create('product_country_prices', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->constrained()->onDelete('cascade');
            $table->string('locale')->default('uk')->index();
            $table->string('code')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_country_prices');
    }
};
