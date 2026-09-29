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
    Schema::table('aid_requests', function (Blueprint $table) {
        $table->enum('unit', ['kg', 'bag', 'piece', 'bottle', 'box', 'litre', 'person'])->default('piece')->after('quantity');
    });
}

public function down()
{
    Schema::table('aid_requests', function (Blueprint $table) {
        $table->dropColumn('unit');
    });
}
};
