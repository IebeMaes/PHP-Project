<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailtemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailtemplates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mailcontent');
            $table->timestamps();
        });

        for ($i = 0; $i <= 5; $i++) {
            DB::table('mailtemplates')->insert(
                [
                    'name' => "template $i",
                    'mailcontent' => "Dit is de inhoud van template $i",
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailtemplates');
    }
}
