<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaypartActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daypart_activities', function (Blueprint $table) {
            $table->bigIncrements('id');

            //foreign keys
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

            $table->unsignedBigInteger('daypart_id')->nullable();
            $table->foreign('daypart_id')->references('id')->on('dayparts')->onDelete('set null'); //was restrict

            $table->timestamps();
        });


        DB::table('daypart_activities')->insert(

            [
                [
                    //1
                    'activity_id' => 1,
                    'daypart_id' => 1,
                ],
                [
                    //2
                    'activity_id' => 1,
                    'daypart_id' => 2,
                ],
                [
                    //3
                    'activity_id' => 1,
                    'daypart_id' => 3,
                ],
                [
                    //4
                    'activity_id' => 2,
                    'daypart_id' => 1,
                ],
                [
                    //5
                    'activity_id' => 2,
                    'daypart_id' => 2,
                ],
                [
                    //6
                    'activity_id' => 3,
                    'daypart_id' => 4,
                ],
                [
                    //7
                    'activity_id' => 3,
                    'daypart_id' => 5,
                ],
                [
                    //8
                    'activity_id' => 4,
                    'daypart_id' => 1,
                ],
                [
                    //9
                    'activity_id' => 4,
                    'daypart_id' => 2,
                ],
                [
                    //10
                    'activity_id' => 4,
                    'daypart_id' => 3,
                ],
                [
                    //11
                    'activity_id' => 5,
                    'daypart_id' => 1,
                ],
                [
                    //12
                    'activity_id' => 5,
                    'daypart_id' => 3,
                ],
                [
                    //13
                    'activity_id' => 6,
                    'daypart_id' => 2,
                ],
                [
                    //14
                    'activity_id' => 6,
                    'daypart_id' => 3,
                ],
                [
                    //15
                    'activity_id' => 7,
                    'daypart_id' => 6,
                ],
                [
                    //16
                    'activity_id' => 8,
                    'daypart_id' => 6,
                ],
                [
                    //17
                    'activity_id' => 9,
                    'daypart_id' => 6,
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
        Schema::dropIfExists('daypart_activities');
    }
}
