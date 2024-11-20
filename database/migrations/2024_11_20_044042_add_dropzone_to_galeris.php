<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDropzoneToGaleris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->boolean('dropzone')->default(0)->nullable();
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->boolean('dropzone')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('galeris', function (Blueprint $table) {
            $table->dropColumn('dropzone');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('dropzone');
        });
    }
}
