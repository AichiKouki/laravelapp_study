<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *コマンドで実行されるのはこのファイル。だから、新たに作ったシーダーファイルをここで呼び出す必要がある
     * @return void
     */
    public function run()
    {
        //一回やったらコメントアウトする。すでにデータが入っているのにこれを動かしたら、またテーブルに初期値が追加されてしまうので、終わったらコメントしておく
        //$this->call(UsersTableSeeder::class);
        //$this->call(PeopleTableSeeder::class);
        //$this->call(RestdataTableSeeder::class);
    }
}
