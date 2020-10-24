<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationtasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrationtasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            //foreign keys
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('set null');


            //$table->unsignedBigInteger('participant_id')->nullable();
            //$table->foreign('participant_id')->references('id')->on('participants')->onDelete('set null');


            $table->unsignedBigInteger('participant_id');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');


            $table->unsignedBigInteger('chosentransport_id')->nullable();
            $table->foreign('chosentransport_id')->references('id')->on('chosentransports')->onDelete('set null');

            $table->timestamps();

        });
        DB::table('registrationtasks')->insert(

            [
                [
                    'task_id' => 1,
                    'participant_id' => 1,
                    'chosentransport_id' => 11,


                ],

                [
                    'task_id' => 2,
                    'participant_id' => 2,
                    'chosentransport_id' => 1,


                ],

                [
                    'task_id' => 3,
                    'participant_id' => 3,
                    'chosentransport_id' => 12,


                ],

                [
                    'task_id' => 4,
                    'participant_id' => 4,
                    'chosentransport_id' => 5,


                ],

                [
                    'task_id' => 5,
                    'participant_id' => 5,
                    'chosentransport_id' => 8,


                ],
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
        Schema::dropIfExists('registrationtasks');
    }
}
