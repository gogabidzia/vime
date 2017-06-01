<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Storage;
class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Storage::makeDirectory('/resumes');
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('link');
            $table->string('type');
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
        Storage::deleteDirectory('/resumes');
        Schema::dropIfExists('videos');
    }
}
