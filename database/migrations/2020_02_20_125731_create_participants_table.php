<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('cellphone')->nullable();
            $table->string('email')->unique();
            $table->string('unumber')->nullable();
            $table->string('link')->nullable();
            $table->string('kind');
            $table->timestamps();
        });

        DB::table('participants')->insert(

            [
                [
                    'id' => 1,
                    'first_name' => 'Bert',
                    'last_name' => 'Vermeulen',
                    'cellphone' => '0478521235',
                    'email' => 'test1@gmail.com',
                    'unumber' => null,
                    'kind' => 'helper'
                ],
                [
                    'id' => 2,
                    'first_name' => 'Bart',
                    'last_name' => 'Berend',
                    'cellphone' => '0492812315',
                    'email' => 'test2@gmail.com',
                    'unumber' => null,
                    'kind' => 'helper'
                ],
                [
                    'id' => 3,
                    'first_name' => 'Jos',
                    'last_name' => 'Vermijlen',
                    'cellphone' => '0445127845',
                    'email' => 'test3@gmail.com',
                    'unumber' => 'U123456',
                    'kind' => 'participant'
                ],
                [
                    'id' => 4,
                    'first_name' => 'Robin',
                    'last_name' => 'Keulemans',
                    'cellphone' => '0478442295',
                    'email' => 'test4@gmail.com',
                    'unumber' => 'U655845',
                    'kind' => 'participant'
                ],
                [
                    'id' => 5,
                    'first_name' => 'Koen',
                    'last_name' => 'Bats',
                    'cellphone' => '0478599995',
                    'email' => 'test5@gmail.com',
                    'unumber' => null,
                    'kind' => 'helper'
                ]
            ]
        );
        for ($i = 0; $i <= 40; $i++) {
            DB::table('participants')->insert(
                [
                    'first_name' => "Deelnemer $i",
                    'last_name' => 'Verheyen',
                    'email' => "Deelnemer$i@mailinator.com",
                    'cellphone' => '04' . strval(rand(10000000,99999999)),
                    'unumber' => '',
                    'link' => '',
                    'kind' => 'helper'


                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
