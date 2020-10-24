<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('town');
            $table->string('postalcode');
            $table->string('street');
            $table->string('name')->nullable();
            $table->timestamps();

        });

        DB::table('locations')->insert(

            [
                [
                    'town' => 'Geel',
                    'postalcode' => '2440',
                    'street' => 'Kleinhoefstraat 4',
                    'name' => 'campus'

                ],
                [
                    'town' => 'Geel',
                    'postalcode' => '2440',
                    'street' => 'Zwaarvoerdersspoor 3',
                    'name' => 'voetbalveld'
                ],
                [
                    'town' => 'Geel',
                    'postalcode' => '2440',
                    'street' => 'Zwaarvoerdersspoor 4',
                    'name' => 'sporthal'
                ],
                [
                    'town' => 'Geel',
                    'postalcode' => '2440',
                    'street' => 'Fehrenbachstraat 26a',
                    'name' => 'zwembad'
                ],
                [
                    'town' => 'Geel',
                    'postalcode' => '2440',
                    'street' => 'Bel 15',
                    'name' => 'den bruul'
                ],
                [
                    'town' => 'Geel',
                    'postalcode' => '2440',
                    'street' => 'Bel 19/1',
                    'name' => 'tafeltennis'
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
        Schema::dropIfExists('locations');
    }
}
