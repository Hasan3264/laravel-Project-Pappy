<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->integer('cetegory_id');
            $table->integer('sub_cetegory_id')->nullable();
            $table->string('banner_preview');
            $table->string('small_title');
            $table->string('big_title');
            $table->string('big_title_sub');
            $table->string('banner_details');
            $table->integer('price');
            $table->integer('after_discount')->nullable();
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
        Schema::dropIfExists('banners');
    }
}
