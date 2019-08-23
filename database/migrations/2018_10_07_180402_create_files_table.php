<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userid')->nullable($value = true);
            $table->string('trackid')->nullable($value = true);
            $table->string('latitude');
            $table->string('longitude');
            $table->text('description');
            $table->string('audio')->nullable($value = true);
            $table->string('video')->nullable($value = true);
            $table->string('image')->nullable($value = true);
            $table->string('legend')->nullable($value = true);
            $table->integer('legendvalue')->default(0);
            $table->integer('project');
            $table->boolean('upload');
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
        Schema::dropIfExists('files');
    }
}
