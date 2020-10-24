<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->time('start_hour');
            $table->time('end_hour')->nullable();
            $table->integer('min_number')->nullable();
            $table->integer('max_number')->nullable();
            $table->string('note')->nullable();

            //foreign keys
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('set null');


            $table->timestamps();
        });


        DB::table('tasks')->insert(

            [
                [
                'name' => 'Volleybal',
                'description' => 'Net opzetten en ballen klaarzetten',
                'start_hour' => '13:00:00',
                'end_hour' => '15:00:00',
                'min_number' => 2,
                'max_number' => 4,
                'note' => 'Breng schoenen mee die tegen zand kunnen',
                    'activity_id' => 5

                    ]
            ,
                [
                    'name' => 'Voetbal',
                    'description' => 'voetbalvelden proper maken',
                    'start_hour' => '13:00:00',
                    'end_hour' => '14:00:00',
                    'min_number' => 1,
                    'max_number' => 3,
                    'activity_id' => 1,
                    'note' => null


                ],
                [
                    'name' => 'BBQ',
                    'description' => 'Eten klaarmaken, tafels klaarzetten, opdienen',
                    'start_hour' => '18:00:00',
                    'end_hour' => '20:00:00',
                    'min_number' => 7,
                    'max_number' => 15,
                    'activity_id' => 7,
                    'note' => null


                ],
                [
                    'name' => 'Bowling',
                    'description' => 'Mensen ontvangen',
                    'start_hour' => '14:00:00',
                    'end_hour' => '16:00:00',
                    'min_number' => 1,
                    'max_number' => 2,
                    'note' => 'Kennis van bowling kan handig zijn',
                    'activity_id' => 3

                ],
                [
                    'name' => 'Badminton',
                    'description' => 'netten opstellen',
                    'start_hour' => '15:00:00',
                    'end_hour' => '16:00:00',
                    'min_number' => 2,
                    'max_number' => 4,
                    'activity_id' => 2,
                    'note' => null

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
        Schema::dropIfExists('tasks');
    }
}
