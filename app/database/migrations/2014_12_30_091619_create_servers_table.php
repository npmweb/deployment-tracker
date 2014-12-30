<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('uid', 8);
			$table->string('display_name', 50);
			$table->string('hostname', 100);
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
        Schema::drop('servers');
    }

}
