<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffpartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffparties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('date');

            //foreign keys
            $table->unsignedBigInteger('location_id')->nullable();

            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');

        });

        DB::table('staffparties')->insert(

            [
                [
                    'name' => 'personeelsfeest 2020',
                    'date' => '2020/01/01',
                    'location_id' => 1

                ],
                [
                    'name' => 'personeelsfeest 2021',
                    'date' => '2021/01/01',
                    'location_id' => 1

                ],
                [
                    'name' => 'personeelsfeest 2022',
                    'date' => '2022/01/01',
                    'location_id' => 1

                ],
                [
                    'name' => 'personeelsfeest 2023',
                    'date' => '2023/01/01',
                    'location_id' => 1

                ],
                [
                    'name' => 'personeelsfeest 2024',
                    'date' => '2024/01/01',
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
        Schema::dropIfExists('staffparties');
    }
}
