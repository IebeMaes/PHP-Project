<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomactivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roomactivities', function (Blueprint $table) {
            $table->bigIncrements('id');

            //foreign keys
            $table->unsignedBigInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('set null');

            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('set null');


            $table->timestamps();
        });


        DB::table('roomactivities')->insert(

            [
                [
                    'room_id' => 1,
                    'activity_id' => 4,
                ],
                [
                    'room_id' => 2,
                    'activity_id' => 4,
                ],
                [
                    'room_id' => 3,
                    'activity_id' => 2,
                ],
                [
                    'room_id' => 4,
                    'activity_id' => 2,
                ],
                [
                    'room_id' => 5,
                    'activity_id' => 5,
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
        Schema::dropIfExists('roomactivities');
    }
}
