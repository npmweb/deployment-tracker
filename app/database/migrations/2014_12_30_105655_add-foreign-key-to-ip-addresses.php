<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToIpAddresses extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ip_addresses', function($table)
        {
            $table->foreign('server_id')
                ->references('id')->on('servers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ip_addresses', function($table)
        {
            $table->dropForeign('ip_addresses_server_id_foreign');
        });
    }

}
