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
        Schema::create('music_instrumentation', function (Blueprint $table) {
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('instrumentation_id');
            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('instrumentation_id')->references('id')->on('instrumentations')->onDelete('cascade');
            $table->primary(['music_id', 'instrumentation_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('music_instrumentation');
    }
};
