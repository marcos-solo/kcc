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
    Schema::create('media_items', function (Blueprint $table) {
        $table->id();
        $table->string('title');              // e.g., Publications
        $table->string('slug')->unique();     // e.g., publications
        $table->string('route_name');         // e.g., media.publications
        $table->integer('order')->default(0); // optional: for ordering
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};
