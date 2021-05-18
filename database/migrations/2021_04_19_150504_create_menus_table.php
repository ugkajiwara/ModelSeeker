<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->references('id')->on('users'); //FK from Users
            
            //メニュー名、所要時間、料金、モデルに課す条件（nullable）、
            $table->string('menu_name', 100); //メニュー名
            $table->tinyInteger('minutes'); //施術時間
            $table->string('charge', 10); //料金
            $table->string('requirements', 500)->nullable($value = true); //モデルに課す条件
            $table->boolean('is_deleted')->default(0); //削除済みかどうか
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
        Schema::dropIfExists('menus');
    }
}
