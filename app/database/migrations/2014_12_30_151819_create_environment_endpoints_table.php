<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEnvironmentEndpointsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('environment_endpoints', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('environment_id')->unsigned();
            $table->integer('endpoint_id')->unsigned();
            $table->integer('domain_id')->unsigned();
            $table->string('path', 50);
            $table->timestamps();

            $table->foreign('environment_id')
                ->references('id')->on('environments');
            $table->foreign('endpoint_id')
                ->references('id')->on('endpoints');
            $table->foreign('domain_id')
                ->references('id')->on('domains');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('environment_endpoints');
    }

}
