<?php
//Bladeのテンプレートを使ってみるコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた

class HelloController extends Controller
{
//コントローラからBladeテンプレートを使う
    public function index(){//helloにアクセスした時のアクション
    	//resources/views/hello/index.phpにある。このテンプレートに値を渡してレンダリング
    	//['msg'=>'メッセージ']
    	//$msg   ←テンプレートでは上記のように連想配列のキーと同じ名前で受け取れる

    	$data=['one','two','three','four','five'];
    	return view('hello.index',['data'=>$data]);//第一引数は、フォルダ名.ファイル名。第二引数はtemplateに渡す値となる連想配列
    }
    
    //フォームを送信した時の処理のアクション
    /*
    public function post(Request $request){//Requestインスタンスを引数に用意してあります
    
        //$request->msg;は、name="msg"を指定してあったフィールドの値はこれで取り出し
    	return view('hello.index',['msg'=>$request->msg]);//bladeテンプレートに値を渡してレンダリング
    }
    */
}