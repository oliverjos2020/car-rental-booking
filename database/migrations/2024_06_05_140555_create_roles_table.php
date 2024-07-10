<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->string('slug')->unique();
            $table->timestamps();
        });
        $this->insertDefaultData();

    }

      private function insertDefaultData()
    {
        $data = [
            ['role' => 'Admin', 'slug' => Str::of(Str::lower('Admin'))->slug('-')],
            ['role' => 'Car Renters', 'slug' => Str::of(Str::lower('Car Renters'))->slug('-')],
            ['role' => 'Ride Providers', 'slug' => Str::of(Str::lower('Ride Providers'))->slug('-')],
            ['role' => 'Users', 'slug' => Str::of(Str::lower('Users'))->slug('-')]
            // Add more default data as needed
        ];

        DB::table('roles')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
