<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *runメソッドの中に、レコード作成のための処理を記述する
     * @return void
     */
    public function run()
    {
        //レコード1つ目作成
        $param=[
            'name'=>'yamamotosayaka',
            'mail'=>'sayane@nmb.com',
            'age'=>'25',
        ];
        DB::table('people')->insert($param);
        
        //レコード2つ目作成
        $param=[
            'name'=>'watanabemiyuki',
            'mail'=>'miruki@nmb.com',
            'age'=>'24',
        ];
        DB::table('people')->insert($param);
    }
}
