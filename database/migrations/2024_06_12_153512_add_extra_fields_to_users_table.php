<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AddExtraFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('meansOfIdentification')->nullable();
            $table->string('identificationDocument')->nullable();
            $table->string('bank')->nullable();
            $table->string('accountNumber')->nullable();
            $table->string('accountName')->nullable();
            $table->string('accountType')->nullable();
            $table->string('passport')->nullable();
        });

        $this->insertDefaultData();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
        });
    }

    private function insertDefaultData()
    {
        $data = [
            ['name' => 'Admin DPL', 'email' => 'admin@dpl.com', 'phone_no' => '07062902972', 'password' => Hash::make(12345678), 'role_id' => 1, 'created_at' => Carbon::now(),]
            // Add more default data as needed
        ];

        DB::table('users')->insert($data);
    }
}
