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
    Schema::create('aid_requests', function (Blueprint $table) {
        $table->id();
        $table->string('requester_name')->default('Anonymous');
        $table->string('contact_number')->nullable();
        $table->string('location');
        $table->string('resource_needed');
        $table->integer('quantity');
        $table->enum('status', ['Pending', 'Approved', 'Delivered'])->default('Pending');
        $table->timestamps();
    });
}
};