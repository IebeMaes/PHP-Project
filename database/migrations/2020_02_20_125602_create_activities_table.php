<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('sort');
            $table->integer('min_number')->nullable();
            $table->integer('max_number')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->boolean('active')->default(true);

            //foreign keys

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');

            $table->timestamps();
        });


        DB::table('activities')->insert(

            [
                [
                    'name' => 'Voetbal',
                    'description' => 'Voetballen met enkele andere collegas ',
                    'sort' => 'Korte activiteit',
                    'min_number' => 10,
                    'max_number' => 20,
                    'location_id' => 2
                ],
                [
                    'name' => 'Badminton',
                    'description' => 'Badminton spelen met enkele collegas',
                    'sort' => 'Korte activiteit',
                    'min_number' => 2,
                    'max_number' => 4,
                    'location_id' => 3
                ],
                [
                    'name' => 'Bowling',
                    'description' => 'Bowling spelen met enkele collegas',
                    'sort' => 'Lange activiteit',
                    'min_number' => 3,
                    'max_number' => 8,
                    'location_id' => 4
                ],
                [
                    'name' => 'Tafeltennis',
                    'description' => 'Tafeltennis spelen met enkele collegas',
                    'sort' => 'Korte activiteit',
                    'min_number' => 2,
                    'max_number' => 4,
                    'location_id' => 6
                ],
                [
                    'name' => 'Volleybal',
                    'description' => 'Volleybal spelen met enkele collegas',
                    'sort' => 'Korte activiteit',
                    'min_number' => 6,
                    'max_number' => 12,
                    'location_id' => 3
                ],
                [
                    'name' => 'Zaalvoetbal',
                    'description' => 'Zaalvoetbal spelen met enkele collegas',
                    'sort' => 'Korte activiteit',
                    'min_number' => 6,
                    'max_number' => 12,
                    'location_id' => 3
                ],
                [
                    'name' => 'Vlees',
                    'description' => 'Eten (vlees) met daarna een feest',
                    'sort' => 'Avond activiteit',
                    'min_number' => null,
                    'max_number' => null,
                    'location_id' => 1
                ],

                [
                    'name' => 'Vis',
                    'description' => 'Eten (vis) met daarna een feest',
                    'sort' => 'Avond activiteit',
                    'min_number' => null,
                    'max_number' => null,
                    'location_id' => 1
                ],

                [
                    'name' => 'Vegetarisch',
                    'description' => 'Eten (vegetarisch) met daarna een feest',
                    'sort' => 'Avond activiteit',
                    'min_number' => null,
                    'max_number' => null,
                    'location_id' => 1
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
        Schema::dropIfExists('activities');
    }
}
