<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Shop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ShopList', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ShopOwner', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('ShopId');
            $table->bigInteger('OwnerId');
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ShopList');
    }
}
