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
    Schema::table('missing_people', function (Blueprint $table) {
        $table->string('image')->nullable()->after('gender'); // Stores the path to the image
    });
}

public function down()
{
    Schema::table('missing_people', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}

    
   
};
