<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//トップページにアクセスしたときの処理について記述したもの
Route::get('/', function () { //Route::get(アドレス,関数など)
    return view('welcome'); //*1
});

//自作のルート情報を追加
/*
//このように、コントローラではなく直接HTMLコードをreturnすることもできる
Route::get('hello',function(){
	return '<html><body><h1>Hello</h1><p>This is sample page.</p></body></html>';
});
*/

//helloにアクセスしたら、HelloControllerのアクションメソッドindexが呼ばれる
//シングルアクションコントローラーを使う場合は、アクション名は指定せずコントローラーの名前だけでいい
Route::get('single','SingleActionController');
//リクエストとレスポンスを行う
Route::get('request_response','RequestResponseController@index');

//フォームを利用する
//同じアドレスでも、GETやPOSTのようにアクセスするメソッドの種類が違えば両方使える
Route::get('hello','HelloController@index');//helloにアクセスした時にindexアクションを処理
//POST送信は、「Route::post」というメソッドで設定します
//Route::post('hello','HelloController@post');//helloにアクセスした時にpostアクションも処理

/*
*1
そのアドレスにアクセスした際に表示される内容。
view(テンプレート名)
このviewは、指定したテンプレートファイルをロードし、レンダリングして返す働きをします。
要するに、このviewで引数にテンプレートを指定すると、それがレンダリングされて返され、ブラウザに表示されるという仕組みになっている。
今回指定したwelcomeは、resources/viewの中にある
*/