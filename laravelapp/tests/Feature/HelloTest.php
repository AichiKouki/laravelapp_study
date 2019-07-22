<?php
//ユニットテストのスクリプト(php artisan make:test HelloTest)のコマンドでこのファイルが生成された
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use DatabaseMigrations;
use App\Person;

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
        //assertTrueを使ってみる。これは、引数の値がtrueかどうか。
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
        //$response->assertStatus(200);
        //ページのないアドレスにアクセスして、結果が404となるのかを確認。ページが見つからない場合は404エラーとなる。
        $response = $this->get('/no_route');
        $response->assertStatus(404);
      }

      /**
       * データベースをテストする。
       *
       * @return void
       */
       public function testDB(){
         //ダミーで利用するデータ
         //factory-createでレコードを新たに作り保存することができる
         //指定した値でレコードを保存させたい場合は、createの引数に連想配列で値を用意しておきます。
         factory(User::class)->create([
           'name' => 'AAA',
           'mail' => 'BBB@CCC.COM',
           'password' => 'ABCABC',
           'age' => 123,
         ]);
         //レコードを多数作成したい場合は、第二引数に作成するインスタンス数を指定
         factory(User::class,10)->create();

         $this->assertDatabaseHas('users',[
           'name' => 'AAA',
           'mail' => 'BBB@CCC.COM',
           'password' => 'ABCABC',
           'age' => 123,
         ]);

         //ダミーで利用するデータ
         factory(Person::class)->create([
           'name' => 'XXX',
           'mail' => 'YYY@ZZZ.COM',
           'password' => 'ABCABC',
           'age' => 123,
         ]);
         factory(Person::class)->create();

         $this->assertDatabaseHas([
           'name' => 'XXX',
           'mail' => 'YYY@ZZZ.COM',
           'password' => 'ABCABC',
           'age' => 123,
         ]);
       }

}
