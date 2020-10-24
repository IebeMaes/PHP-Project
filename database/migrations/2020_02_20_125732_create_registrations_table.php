<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('note')->nullable();

            //foreign keys
            $table->unsignedBigInteger('participant_id')->nullable();
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('set null');

            $table->unsignedBigInteger('daypart_activity_id')->nullable();
            $table->foreign('daypart_activity_id')->references('id')->on('daypart_activities')->onDelete('set null');

            $table->unsignedBigInteger('chosentransport_id')->nullable();
            $table->foreign('chosentransport_id')->references('id')->on('chosentransports')->onDelete('set null');


            $table->timestamps();
        });


        DB::table('registrations')->insert(

            [
                [
                    'participant_id' => 1,
                    'daypart_activity_id' => 1,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                [
                    'participant_id' => 1,
                    'daypart_activity_id' => 10,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                [
                    'participant_id' => 1,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                //-------------------//
                [
                    'participant_id' => 2,
                    'daypart_activity_id' => 1,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                [
                    'participant_id' => 2,
                    'daypart_activity_id' => 12,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                [
                    'participant_id' => 2,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                //-------------------//
                [
                    'participant_id' => 3,
                    'daypart_activity_id' => 1,
                    'chosentransport_id' => 2,
                    'note' => null
                ],
                [
                    'participant_id' => 3,
                    'daypart_activity_id' => 10,
                    'chosentransport_id' => 2,
                    'note' => null
                ],
                [
                    'participant_id' => 3,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 4,
                    'daypart_activity_id' => 1,
                    'chosentransport_id' => 3,
                    'note' => null
                ],
                [
                    'participant_id' => 4,
                    'daypart_activity_id' => 14,
                    'chosentransport_id' => 3,
                    'note' => null
                ],
                [
                    'participant_id' => 4,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 5,
                    'daypart_activity_id' => 1,
                    'chosentransport_id' => 1,
                    'note' => ''
                ],
                [
                    'participant_id' => 5,
                    'daypart_activity_id' => 10,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                [
                    'participant_id' => 5,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 6,
                    'daypart_activity_id' => 1,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                [
                    'participant_id' => 6,
                    'daypart_activity_id' => 12,
                    'chosentransport_id' => 1,
                    'note' => null
                ],
                [
                    'participant_id' => 6,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 7,
                    'daypart_activity_id' => 6,
                    'chosentransport_id' => 5,
                    'note' => null
                ],
                [
                    'participant_id' => 7,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 8,
                    'daypart_activity_id' => 6,
                    'chosentransport_id' => 5,
                    'note' => null
                ],
                [
                    'participant_id' => 8,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 9,
                    'daypart_activity_id' => 6,
                    'chosentransport_id' => 5,
                    'note' => null
                ],
                [
                    'participant_id' => 9,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 10,
                    'daypart_activity_id' => 5,
                    'chosentransport_id' => 2,
                    'note' => null
                ],
                [
                    'participant_id' => 10,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 2,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 11,
                    'daypart_activity_id' => 7,
                    'chosentransport_id' => 6,
                    'note' => null
                ],
                [
                    'participant_id' => 11,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 2,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 12,
                    'daypart_activity_id' => 7,
                    'chosentransport_id' => 6,
                    'note' => null
                ],
                [
                    'participant_id' => 12,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 13,
                    'daypart_activity_id' => 7,
                    'chosentransport_id' => 6,
                    'note' => null
                ],
                [
                    'participant_id' => 13,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 14,
                    'daypart_activity_id' => 7,
                    'chosentransport_id' => 6,
                    'note' => null
                ],
                [
                    'participant_id' => 14,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 15,
                    'daypart_activity_id' => 7,
                    'chosentransport_id' => 6,
                    'note' => null
                ],
                [
                    'participant_id' => 15,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 16,
                    'daypart_activity_id' => 7,
                    'chosentransport_id' => 6,
                    'note' => null
                ],
                [
                    'participant_id' => 16,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 1,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 17,
                    'daypart_activity_id' => 7,
                    'chosentransport_id' => 6,
                    'note' => null
                ],
                [
                    'participant_id' => 17,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 2,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 18,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 2,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 19,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 3,
                    'note' => null
                ],

                //-------------------//
                [
                    'participant_id' => 20,
                    'daypart_activity_id' => 15,
                    'chosentransport_id' => 2,
                    'note' => null
                ],
                [
                    'participant_id' => 21,
                    'daypart_activity_id' => 16,
                    'chosentransport_id' => 2,
                    'note' => null
                ],
                [
                    'participant_id' => 22,
                    'daypart_activity_id' => 16,
                    'chosentransport_id' => 2,
                    'note' => null
                ],

                [
                    'participant_id' => 23,
                    'daypart_activity_id' => 17,
                    'chosentransport_id' => 2,
                    'note' => null
                ],
                [
                'participant_id' => 24,
                'daypart_activity_id' => 17,
                'chosentransport_id' => 2,
                'note' => null
            ],

            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return v
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
