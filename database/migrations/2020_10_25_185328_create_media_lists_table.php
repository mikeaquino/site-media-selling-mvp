<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('mediagroup_id');
            $table->string('media_name');
            $table->string('medianame_url');
            $table->string('media_description');
            $table->string('media');
            $table->mediumText('media_thumbnail')->nullable();
            $table->string('typeof_media');
            $table->integer('media_filesize');
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
        Schema::dropIfExists('media_lists');
    }
}
