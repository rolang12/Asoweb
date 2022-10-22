<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amigos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('to_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('status');
            $table->string('leido')->default('No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amigos');
    }
}
