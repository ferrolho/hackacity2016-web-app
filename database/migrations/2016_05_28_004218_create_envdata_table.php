<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnvdataTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('envdata', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('timestamp');
            $table->float('coord_x');
            $table->float('coord_y');

            $table->float('co');
            $table->float('no2');
            $table->float('proc_no2');
            $table->float('o3');
            $table->float('proc_o3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('envdata');
    }

}
