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
    DB::statement("ALTER TABLE disaster_reports MODIFY COLUMN status ENUM('Active', 'Contained', 'Resolved') NOT NULL DEFAULT 'Active'");
}

public function down()
{
    DB::statement("ALTER TABLE disaster_reports MODIFY COLUMN status ENUM('Active', 'Contained') NOT NULL DEFAULT 'Active'");
}
    /**
     * Reverse the migrations.
     */
};
