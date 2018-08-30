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
        // $this->call(UsersTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
    }
}
