<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('media_items', function (Blueprint $table) {
            $table->string('file')->nullable()->after('type');
        });
    }

    public function down()
    {
        Schema::table('media_items', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};