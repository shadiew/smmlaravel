<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referral_bonuses', function (Blueprint $table) {
            $table->id();
            $table->integer('from_user_id')->nullable();
            $table->integer('to_user_id')->nullable();
            $table->integer('level')->nullable();
            $table->decimal('amount',18,8)->default(0);
            $table->decimal('main_balance',18,8)->default(0);
            $table->string('transaction',25)->nullable();
            $table->string('type',10)->nullable();
            $table->string('remarks',191)->nullable();
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
        Schema::dropIfExists('referral_bonuses');
    }
}
