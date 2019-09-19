<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartPriceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_price_lists', function (Blueprint $table) {
            $table->string('id');
            $table->string('name');
            $table->text('description')->nullable($value=true);
            $table->text('rep_new')->nullable($value=true);
            $table->string('machine')->nullable($value=true);
            $table->integer('quantity')->nullable($value=true);
            $table->float('price',12,2)->nullable($value=true);
            $table->string('vn_name')->nullable($value=true);
            $table->string('material')->nullable($value=true);
            $table->string('detail')->nullable($value=true);
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
        Schema::dropIfExists('part_price_lists');
    }
}
