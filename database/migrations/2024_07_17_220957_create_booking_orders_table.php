<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete()->nullable();
            $table->date('pickupDate')->nullable();
            $table->string('pickupTime')->nullable();
            $table->date('dropoffDate')->nullable();
            $table->string('dropoffTime')->nullable();
            $table->integer('duration')->nullable();
            $table->decimal('amount')->nullable();
            $table->char('payment_status', 1)->default('0');
            $table->char('status', 1)->default('0');
            $table->string('entertainmentMenu')->nullable();
            $table->string('event')->nullable();
            $table->string('address')->nullable();
            $table->string('participants')->nullable();
            $table->string('hours')->nullable();
            $table->string('no_of_stops')->nullable();
            $table->string('selectedMenus')->nullable();
            $table->string('entertainment_date')->nullable();
            $table->char('entertainment', 1)->default('0');
            $table->string('stop_location')->nullable();
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
        Schema::dropIfExists('booking_orders');
    }
}
