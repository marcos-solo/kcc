<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::table('media_items', function (Blueprint $table) {
    $table->enum('type', ['publication', 'report', 'photo', 'video'])
          ->default('publication')
          ->after('route_name');
    $table->string('file_path')->nullable()->after('type');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_items', function (Blueprint $table) {
            //
        });
    }
};
