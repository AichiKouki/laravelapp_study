<?php
//ユニットテストのスクリプト(php artisan make:test HelloTest)のコマンドでこのファイルが生成された
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use DatabaseMigrations;

class HelloTest extends TestCase
{

    /**
     * Laravel以前の問題として、PHPの一般的な値(数値やテキスト、配列など)をチェック
     *
     * @return void
     */
     public function testNormalValue(){
       $this->assertTrue(true);

       $arr = [];
       $this->assertEmpty($arr);

       $msg = "Hello";
       $this->assertEquals('Hello',$msg);

       $n = random_int(0,100);
       $this->assertLessThan(100,$n);
     }

     /**
      * 指定したパスが202番になったり404番になるかどうかを調べる
      *
      * @return void
      */
      public function testPath(){
        $this->assertTrue(true);

        //アクセスしたステータスを調べて、正常にアクセスできたら200番
        $response = $this->get('/');
        $response->assertStatus(200);
        //「/hello」にアクセスした時、ページは存在するがアクセスできないことを表す302になるかどうかを調べる。認証が必要だから。
        $response = $this->get('/hello');
        $response->assertStatus(302);
        //fatoryでモデルの作成を行なっている。
        //以下で生成するユーザーデータはUsersテーブルになくてもいい。登録されていない値を設定されたUserインスタンスでもログインしてアクセスできる。
        $user = factory(User::class)->create();//テストを実行するたびに、factoryを使ってデータを挿入する。
        $response = $this->actingAs($user)->get('/hello');//actingAs()を使うことでユーザーデータを認証済み状態にできる。
        $response->assertStatus(200);

        $response = $this->get('/no_route');
        $response->assertStatus(404);
      }

}
