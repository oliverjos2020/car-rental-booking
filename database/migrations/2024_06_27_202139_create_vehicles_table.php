<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('reason')->nullable();
            $table->string('location')->nullable();
            $table->enum('driverLicense', ['yes', 'no'])->nullable();
            $table->string('vehicleMake')->nullable();
            $table->string('vehicleYear')->nullable();
            $table->string('vehicleModel')->nullable();
            $table->string('transmission')->nullable();
            $table->string('doors')->nullable();
            $table->string('passengers')->nullable();
            $table->enum('airCondition', ['yes', 'no'])->nullable();
            $table->string('seats')->nullable();
            // $table->integer('category')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->nullable();
            $table->foreignId('price_setup_id')->constrained()->cascadeOnDelete()->nullable();
            $table->char('status', 1)->default('0')->nullable();
            $table->dateTime('dateApproved')->nullable();
            $table->char('on_trip', 1)->default('0')->nullable();
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
        Schema::dropIfExists('vehicles');
        Schema::table('vehicles', function (Blueprint $table) {
            // $table->dropColumn('user_id');
            // $table->dropColumn('product_id');
        });

    }
}
