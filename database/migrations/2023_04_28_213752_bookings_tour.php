<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingsTour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings_tour', function(Blueprint $table){
            $table->id();
            $table->string('paypal_order', 500);
            $table->string('folio', 50);
            $table->string('first_name', 500);
            $table->string('last_name', 500);
            $table->string('email', 500);
            $table->string('phone', 15);
            $table->date('departure_date');
            $table->time('departure_time');
            $table->longText('comments')->nullable();
            $table->string('pay_method');
            $table->double('amount', 15, 2);
            $table->integer('id_tour');
            $table->integer('id_vehicle');
            $table->timestamp('creation_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
