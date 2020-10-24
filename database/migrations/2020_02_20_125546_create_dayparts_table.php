<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaypartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dayparts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('start_hour');
            $table->time('end_hour');
            $table->string('description')->nullable();

            //foreign keys

            $table->unsignedBigInteger('staffparty_id')->nullable();
            $table->foreign('staffparty_id')->references('id')->on('staffparties')->onDelete('cascade');



            $table->timestamps();
        });



        DB::table('dayparts')->insert(

            [
                [
                    //1
                    'start_hour' => "14:00:00",
                    'end_hour' => '15:00:00',
                    'description' => 'Korte activiteit',
                    'staffparty_id' => 1

                ],
                [
                    //2
                    'start_hour' => '15:00:00',
                    'end_hour' => '16:00:00',
                    'description' => 'Korte activiteit',
                    'staffparty_id' => 1

                ],
                [
                    //3
                    'start_hour' => '16:00:00',
                    'end_hour' => '17:00:00',
                    'description' => 'Korte activiteit',
                    'staffparty_id' => 1

                ],
                [
                    //4
                    'start_hour' => '14:00:00',
                    'end_hour' => '16:00:00',
                    'description' => 'Lange activiteit',
                    'staffparty_id' => 1

                ],
                [
                    //5
                    'start_hour' => '15:00:00',
                    'end_hour' => '17:00:00',
                    'description' => 'Lange activiteit',
                    'staffparty_id' => 1

                ],
                [
                    //6
                    'start_hour' => '18:00:00',
                    'end_hour' => '22:00:00',
                    'description' => 'Avond activiteit',
                    'staffparty_id' => 1

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
        Schema::dropIfExists('dayparts');
    }
}
