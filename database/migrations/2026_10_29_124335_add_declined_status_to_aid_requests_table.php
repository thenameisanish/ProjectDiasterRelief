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
    DB::statement("ALTER TABLE aid_requests MODIFY COLUMN status ENUM('Pending', 'Approved', 'Declined', 'Delivered') NOT NULL DEFAULT 'Pending'");
}

public function down()
{
    DB::statement("ALTER TABLE aid_requests MODIFY COLUMN status ENUM('Pending', 'Approved', 'Delivered') NOT NULL DEFAULT 'Pending'");
}
};
