<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('relief_materials', function (Blueprint $table) {
            $table->enum('unit', ['kg', 'bag', 'piece', 'bottle', 'box', 'litre'])->default('piece')->after('quantity');
        });
    }

    public function down()
    {
        Schema::table('relief_materials', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }
};