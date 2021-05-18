<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->references('id')->on('users');
            $table->string('menu_id')->references('id')->on('menus');
            $table->string('year', 4); //年
            $table->string('month', 2); //月
            $table->string('day', 2); //日
            // $table->tinyInteger('hour'); //いつ
            // $table->tinyInteger('minute'); //いつ
            $table->string('time', 5); //時:分
            
            $table->boolean('is_reserved')->default(0); //予約済みかどうか
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
        Schema::dropIfExists('calendars');
    }
}
