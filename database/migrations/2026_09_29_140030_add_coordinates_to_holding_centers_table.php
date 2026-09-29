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
    Schema::table('holding_centers', function (Blueprint $table) {
        $table->decimal('latitude', 10, 8)->nullable()->after('name');
        $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        $table->dropColumn('location'); // Remove the old text field
    });
}

public function down()
{
    Schema::table('holding_centers', function (Blueprint $table) {
        $table->string('location')->nullable();
        $table->dropColumn(['latitude', 'longitude']);
    });
}
};
