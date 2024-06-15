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
        Schema::create('music_ensemble_type', function (Blueprint $table) {
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('ensemble_type_id');
            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('ensemble_type_id')->references('id')->on('ensemble_types')->onDelete('cascade');
            $table->primary(['music_id', 'ensemble_type_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('music_ensemble_type');
    }
};
