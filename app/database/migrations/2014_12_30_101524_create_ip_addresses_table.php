<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIpAddressesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('uid', 8);
			$table->integer('server_id')->unsigned();
			$table->string('public_address', 40);
			$table->string('private_address', 40)->nullable();
			$table->timestamps();
		});
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ip_addresses');
    }

}
