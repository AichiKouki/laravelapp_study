<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *upメソッドはテーブルを生成するための処理を記述する
     * @return void
     */
    public function up()
    {
//テーブル作成には、Schemaクラスのcreateメソッドを利用
//第一引数にテーブル名、第二引数にはテーブルを作成するための処理
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mail');
            $table->integer('age');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *downメソッドはテーブルを削除するための処理を記述しておきます
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');//テーブルがあれば削除する
    }
}
