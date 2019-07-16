<?php

use Illuminate\Database\Seeder;

use App\Restdata;

class RestdataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *runメソッドの中に、レコード作成のための処理を記述する
     * @return void
     */
    public function run()
    {
        $param = [
          'message' => 'Google Japan',
          'url' => 'https://www.google.com/?hl=ja'
        ];
        $restdata = new Restdata;//モデルをインスタンス化
        $restdata->fill($param)->save();//fillメソッドでフォームの値を全てのモデルの個々のプロパティにまとめて代入される。saveメソッドでインスタンスを保存

        $param = [
            'message' => 'Yahoo Japan',
            'url' => 'https://www.yahoo.co.jp',
        ];
        $restdata = new Restdata;
        $restdata->fill($param)->save();//fillメソッドでフォームの値を全てのモデルの個々のプロパティにまとめて代入される。saveメソッドでインスタンスを保存

        $param = [
            'message' => 'MSN Japan',
            'url' => 'http://www.msn.com/ja-jp',
        ];
        $restdata = new Restdata;
        $restdata->fill($param)->save();//fillメソッドでフォームの値を全てのモデルの個々のプロパティにまとめて代入される。saveメソッドでインスタンスを保存
    }
}
