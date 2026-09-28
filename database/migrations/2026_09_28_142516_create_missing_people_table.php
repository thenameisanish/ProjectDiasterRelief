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
    Schema::create('missing_people', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('age')->nullable();
        $table->string('gender')->nullable();
        $table->string('last_seen_location');
        $table->enum('status', ['Missing', 'Found Alive', 'Found Dead'])->default('Missing');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missing_people');
    }
};
