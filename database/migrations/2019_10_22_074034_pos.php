<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class POS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SaleList', function (Blueprint $table) {
            $table->string('UID', 256);

            $table->bigInteger('C_Branch')->unsigned();
            $table->string('Wstation', 64);

            $table->dateTime('AccDate');
            $table->string('Invoice',32)->nullable();
            $table->string('Compid', 16)->nullable();
            $table->string('Carrier', 16)->nullable();
            $table->Integer('SaleMt');
            $table->string('Member', 16)->nullable();
            $table->string('Salesman', 16)->nullable();
            $table->dateTime('TimeInsert');

            $table->timestamps();
            $table->softDeletes();

            $table->primary(['UID', 'C_Branch']);
        });

        Schema::create('SaleDetail', function (Blueprint $table) {
            $table->string('UID', 256);
            $table->string('PID', 256);
            $table->bigInteger('C_Branch')->unsigned();

            $table->string('rsn', 32);
            $table->string('scode', 32);
            $table->string('sname', 32);
            $table->Integer('unitprice');
            $table->Integer('saleqty');
            $table->Integer('subtotal');

            $table->timestamps();
            $table->softDeletes();

            $table->primary(['UID', 'C_Branch']);
        });

        Schema::create('GoodCategory', function (Blueprint $table) {
            $table->string('UID', 256);
            $table->bigInteger('C_Branch')->unsigned();

            $table->string('Name', 32);
            $table->string('ShortName', 16)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->primary(['UID', 'C_Branch']);
        });

        Schema::create('GoodList', function (Blueprint $table) {
            $table->string('UID', 256);
            $table->string('Code', 128)->nullable();

            $table->string('Name', 32);
            $table->string('ShortName', 16)->nullable();
            $table->string('CategoryID', 256);
            $table->bigInteger('C_Branch')->unsigned();

            $table->string('Spec', 32)->nullable();
            $table->string('unit', 16);
            $table->Integer('Price');
            $table->Integer('Import_Price')->nullable();

            $table->timestamps();
            $table->softDeletes();
            
            $table->primary(['UID', 'C_Branch']);
        });

        DB::unprepared('ALTER TABLE `SaleList` PARTITION BY HASH(C_Branch) PARTITIONS 1;');
        DB::unprepared('ALTER TABLE `SaleDetail` PARTITION BY HASH(C_Branch) PARTITIONS 1;');
        DB::unprepared('ALTER TABLE `GoodList` PARTITION BY HASH(C_Branch) PARTITIONS 1;');
        DB::unprepared('ALTER TABLE `GoodCategory` PARTITION BY HASH(C_Branch) PARTITIONS 1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SaleList');
        Schema::dropIfExists('SaleDetail');
        Schema::dropIfExists('GoodCategory');
        Schema::dropIfExists('GoodList');
    }
}
