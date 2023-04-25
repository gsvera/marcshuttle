<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookingsTrip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings_trip', function(Blueprint $table)
        {
            $table->id();
            $table->string('paypal_order_id', 255);
            $table->string('folio',50);
            $table->string('first_name', 500);
            $table->string('last_name',500);
            $table->string('email',500);
            $table->string('phone', 15);
            $table->longText('comments');
            $table->integer('id_destination');
            $table->integer('type_transfer');
            $table->string('origin', 500);
            $table->string('destination', 500);
            $table->integer('pax');
            $table->string('pay_method', 50);
            $table->double('amount', 15, 2);
            $table->date('arrival_date');
            $table->time('arrival_time');
            $table->longText('arrival_info');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->longText('departure_info');
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
        
    }
}
