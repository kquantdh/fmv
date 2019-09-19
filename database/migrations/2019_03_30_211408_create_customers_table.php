<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('full_name');
            $table->string('address');
            $table->string('tax')->nullable($value=true);
            $table->string('mobile');
            $table->string('person');
            $table->float('usd_rate');
            $table->float('jpy_rate');
            $table->float('normal_hrs',12,2);
            $table->float('night_hrs',12,2);
            $table->float('off_hrs',12,2);
            $table->float('holiday_hrs',12,2);
            $table->float('transport_price',12,2);
            $table->float('usd_vnd_rate')->nullable($value=true);
            $table->float('jpy_vnd_rate')->nullable($value=true);
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
        Schema::dropIfExists('customers');
    }
}
