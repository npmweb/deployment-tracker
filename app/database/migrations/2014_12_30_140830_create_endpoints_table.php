<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEndpointsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endpoints', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('uid', 8);
            $table->integer('application_id')->unsigned();
            $table->string('name', 50);
            $table->timestamps();

            $table->foreign('application_id')
                ->references('id')->on('applications');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('endpoints');
    }

}
