<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnvironmentIdToServer extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function($table) {
            $table->integer('environment_id')->unsigned();
        });

        // to prevent key errors
        DB::update('UPDATE servers SET environment_id = 2');

        Schema::table('servers', function($table) {
            $table->foreign('environment_id')
                ->references('id')->on('environments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function($table) {
            $table->dropForeign('servers_environment_id_foreign');
            $table->dropColumn('environment_id');
        });
    }

}
