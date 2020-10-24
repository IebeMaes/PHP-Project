<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChosentransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chosentransports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('departuretime')->nullable();
            $table->string('assembly_point')->nullable();

            //foreign keys
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('set null');

            $table->unsignedBigInteger('transportoption_id')->nullable();
            $table->foreign('transportoption_id')->references('id')->on('transportoptions')->onDelete('set null');

            $table->timestamps();

        });


        DB::table('chosentransports')->insert(

            [
                [
                    //1
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 1,
                    'transportoption_id' => 1
                ],
                [
                    //2
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 2,
                    'transportoption_id' => 2
                ],
                [
                    //3
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 4,
                    'transportoption_id' => 2
                ],
                [
                    //4
                    'departuretime' => '13:00:00',
                    'assembly_point' => 'Campus',
                    'activity_id' => 3,
                    'transportoption_id' => 4
                ],

                [
                    //5
                    'departuretime' => '13:45:00',
                    'assembly_point' => 'Campus',
                    'activity_id' => 3,
                    'transportoption_id' => 4
                ],
                [
                    //6
                    'departuretime' => '14:45:00',
                    'assembly_point' => 'Campus',
                    'activity_id' => 3,
                    'transportoption_id' => 4
                ],
                [
                    //7
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 1,
                    'transportoption_id' => 5
                ],
                [
                    //8
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 2,
                    'transportoption_id' => 5
                ],
                [
                    //9
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 4,
                    'transportoption_id' => 1
                ],
                [
                    //11
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 5,
                    'transportoption_id' => 1
                ],
                [
                    //12
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 6,
                    'transportoption_id' => 5
                ],
                [
                    //13
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 6,
                    'transportoption_id' => 1
                ],
                [
                    //14
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 7,
                    'transportoption_id' => 1
                ],
                [
                    //15
                    'departuretime' => null,
                    'assembly_point' => null,
                    'activity_id' => 7,
                    'transportoption_id' => 2
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
        Schema::dropIfExists('chosentransports');
    }
}
