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
    Schema::create('donations', function (Blueprint $table) {
        $table->id();
        $table->string('donor_name');
        $table->string('item_description'); // e.g., $500 or 50 Blankets
        $table->enum('type', ['Cash', 'Item'])->default('Item');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
