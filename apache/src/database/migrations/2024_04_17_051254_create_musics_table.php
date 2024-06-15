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
        Schema::create('musics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('church_hymn_id')->unsigned();
            $table->string('title');
            $table->string('music_score_path')->nullable();
            $table->string('lyrics_path')->nullable();
            $table->string('vocals_mp3_path')->nullable();
            $table->string('organ_mp3_path')->nullable();
            $table->string('preludes_mp3_path')->nullable();
            $table->unsignedBigInteger('language_id')->unsigned();
            $table->string('verses_used')->nullable();
            $table->unsignedBigInteger('created_by')->unsigned();
            $table->unsignedBigInteger('updated_by')->unsigned();
            $table->timestamps();

            $table->foreign('church_hymn_id')->references('id')->on('church_hymns');
            $table->foreign('language_id')->references('id')->on('languages');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('music_category', function (Blueprint $table) {
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->primary(['music_id', 'category_id']);
        });

        Schema::create('music_instrumentation', function (Blueprint $table) {
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('instrumentation_id');

            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('instrumentation_id')->references('id')->on('instrumentations')->onDelete('cascade');

            $table->primary(['music_id', 'instrumentation_id']);
        });

        Schema::create('music_ensemble_type', function (Blueprint $table) {
            $table->unsignedBigInteger('music_id');
            $table->unsignedBigInteger('ensemble_type_id');

            $table->foreign('music_id')->references('id')->on('musics')->onDelete('cascade');
            $table->foreign('ensemble_type_id')->references('id')->on('ensemble_types')->onDelete('cascade');

            $table->primary(['music_id', 'ensemble_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_ensemble_type');
        Schema::dropIfExists('music_instrumentation');
        Schema::dropIfExists('music_category');
        Schema::dropIfExists('musics');
    }
};
