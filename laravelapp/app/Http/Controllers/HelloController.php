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

//nameとmailをまとめた配列データを、更に配列としてまとめたものを用意
    	$data=[
    	['name'=>'山田太郎','mail'=>'taro@yamada'],
    	['name'=>'田中はなこ','mail'=>'hanako@flower'],
    	['name'=>'鈴木さちこ','mail'=>'sachico@happy']
    	];
    	return view('hello.index',['data'=>$data]);//第一引数は、フォルダ名.ファイル名。第二引数はtemplateに渡す値となる連想配列
    }    
}