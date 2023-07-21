<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddColoursToConfiguresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->string('theme_color',20)->nullable()->comment('theme 4');
            $table->string('theme_light_color',20)->nullable()->comment('theme 4');
            $table->string('secondary_color',20)->nullable()->comment('theme 4');
        });

        Schema::table('funds', function (Blueprint $table) {
            $table->string('payment_id',61)->nullable();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colors', function (Blueprint $table) {
            //
        });

        Schema::table('funds', function (Blueprint $table) {
            //
        });

    }
}
