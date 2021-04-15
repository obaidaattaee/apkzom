<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('title');
            $table->json('description');
            $table->string('extension');
            $table->bigInteger('download_counter')->default(1);
            $table->string('original_link')->nullable();
            $table->date('published_at');
            $table->string('size')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('os_type_id');
            $table->unsignedBigInteger('os_version_id');
            $table->unsignedBigInteger('previous_version')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('os_type_id')->references('id')->on('o_s_types');
            $table->foreign('os_version_id')->references('id')->on('o_s_versions');
            $table->foreign('previous_version')->references('id')->on('apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apps');
    }
}
