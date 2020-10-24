<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportoptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('active')->default(true);

            $table->timestamps();
        });


        DB::table('transportoptions')->insert(

            [
                [
                    'name' => 'Auto',
                    'description' => 'eigen vervoer',
                ],
                [
                    'name' => 'Fiets',
                    'description' => 'Eigen vervoer',
                ],
                [
                    'name' => 'Te voet',
                    'description' => 'Eigen vervoer',
                ],
                [
                    'name' => 'Bus',
                    'description' => 'Er is een bus ingelegd naar de locatie van de activiteit',
                ],
                [
                    'name' => 'carpoolen',
                    'description' => 'Meerijden met een collega',
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
        Schema::dropIfExists('transportoptions');
    }
}
