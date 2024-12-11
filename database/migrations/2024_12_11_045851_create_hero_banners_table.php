<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeroBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hero_banners', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('image')->nullable();
            $table->text('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('desc')->nullable();
            $table->text('link')->nullable();
            $table->boolean('visible')->nullable()->default(1);
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
        Schema::dropIfExists('hero_banners');
    }
}
