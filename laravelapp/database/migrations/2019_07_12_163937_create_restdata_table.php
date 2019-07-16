<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestdataTable extends Migration
{
    /**
     * Run the migrations.
     *テーブル生成の処理
     * @return void
     */
    public function up()
    {
        Schema::create('restdata', function (Blueprint $table) {
            $table->increments('id');//プライマリキーとなるフィールド
            $table->string('message');//メッセージを保管するフィールド
            $table->string('url');//関連するアドレスを保管するフィールド
            $table->timestamps();//作成日時と更新日時を表すフィールドが自動生成される。
        });
    }

    /**
     * Reverse the migrations.
     *テーブル削除の処理
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restdata');
    }
}
