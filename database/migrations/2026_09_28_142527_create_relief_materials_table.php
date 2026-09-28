<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('relief_materials', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // e.g., Water Bottles, Tents
        $table->string('category'); // e.g., Food, Water, Medical
        $table->integer('quantity')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relief_materials');
    }
};
