<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *テーブルの生成処理
     * @return void
     */
    public function up()
    {
        //第一引数はテーブル名、第二引数ではクロージャでフィールドを設定している。
        Schema::create('boards', function (Blueprint $table) {
            $table->increments('id');//プライマリキー「id」の指定です。オートインクリメントを指定して設定
            //person_idが外部キーとなるが明示的には指定していない。Eloquentではリレーションの外部キーがモデル名に基づいていると仮定する。
            // この場合は「person」という文字が含まれ知恵るからこれが外部キーとなる。
            $table->integer('person_id');//関連するpoepleテーブルのレコードIDを保管するため。関連するレコードは一つだから、peopleではなく単数形のpersonという名前にしておいた。
            $table->string('title');//タイトルとなるフィールドを用意
            $table->string('message');//メッセージとなるフィールドを用意
            $table->timestamps();//作成日時と更新日時であるcccreated_atとupdated_atフィールドは自動生成される。これら二つのフィールドはlarabelにより自動生成され、値の保存も自動で行ってくれる
        });
    }

    /**
     * Reverse the migrations.
     *テーブルの削除処理
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
