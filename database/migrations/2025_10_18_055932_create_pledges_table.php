<?php

// database/migrations/xxxx_xx_xx_create_pledges_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePledgesTable extends Migration
{
    public function up()
    {
        Schema::create('pledges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('pledge_type'); // e.g., 'tree_challenge' or 'stop_plastic'
            $table->integer('quantity')->nullable(); // e.g., number of trees pledged
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pledges');
    }
}

