<?php
//Bladeのテンプレートを使ってみるコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた

class HelloController extends Controller
{
//コントローラからBladeテンプレートを使う
    public function index(Request $request){//helloにアクセスした時のアクション
    	//resources/views/hello/index.phpにある。このテンプレートに値を渡してレンダリング
    	//['msg'=>'メッセージ']
    	//$msg   ←テンプレートでは上記のように連想配列のキーと同じ名前で受け取れる
    	
    	//viewメソッドの第一引数は、フォルダ名.ファイル名。第二引数はtemplateに渡す値となる連想配列
    	return view('hello.index');
    }    
}