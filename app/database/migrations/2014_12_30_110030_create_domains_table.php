<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDomainsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function(Blueprint $table)
        {
            $table->increments('id');
            $table->char('uid', 8);
            $table->integer('ip_address_id')->unsigned();
            $table->string('name', 100);
            $table->timestamps();

            $table->foreign('ip_address_id')
                ->references('id')->on('ip_addresses');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('domains');
    }

}
