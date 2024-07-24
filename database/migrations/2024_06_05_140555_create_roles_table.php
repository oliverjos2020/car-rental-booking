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
            ['role' => 'partner', 'slug' => Str::of(Str::lower('Partner'))->slug('-')],
            ['role' => 'User', 'slug' => Str::of(Str::lower('User'))->slug('-')]
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
