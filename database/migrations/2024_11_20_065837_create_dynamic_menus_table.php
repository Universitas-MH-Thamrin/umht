<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDynamicMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dynamic_menus', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('level')->nullable()->default('1')->comment('1,2,3');
            $table->string('slug')->nullable();
            $table->string('nama')->nullable();
            $table->text('link')->nullable();
            $table->foreignId('page_id')->nullable();
            $table->integer('urutan')->nullable();
            $table->boolean('visible')->nullable();
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
        Schema::dropIfExists('dynamic_menus');
    }
}
