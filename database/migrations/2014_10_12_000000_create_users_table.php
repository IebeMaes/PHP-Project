<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('head_organizer')->default(false);
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert some organizers
        DB::table('users')->insert(
            [
                [
                    'first_name' => 'Natalie',
                    'last_name' => 'Smets',
                    'email' => 'natalie.smets@thomasmore.be',
                    'password' => Hash::make('admin1234'),
                    'head_organizer' => true
                ],
                [
                    'first_name' => 'Iebe',
                    'last_name' => 'Maes',
                    'email' => 'r0751070@student.thomasmore.be',
                    'password' => Hash::make('admin1234'),
                    'head_organizer' => false
                ],
                [
                    'first_name' => 'Arno',
                    'last_name' => 'Breugelmans',
                    'email' => 'r0630549@student.thomasmore.be',
                    'password' => Hash::make('admin1234'),
                    'head_organizer' => false
                ],
                [
                    'first_name' => 'Robin',
                    'last_name' => 'Thoelen',
                    'email' => 'r0740970@student.thomasmore.be',
                    'password' => Hash::make('admin1234'),
                    'head_organizer' => true
                ],
                [
                    'first_name' => 'Stef',
                    'last_name' => 'Vleugels',
                    'email' => 'r0743880@student.thomasmore.be',
                    'password' => Hash::make('admin1234'),
                    'head_organizer' => false
                ]
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
