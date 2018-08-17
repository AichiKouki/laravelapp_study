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
    	return view('hello.index',['msg'=>'フォームを入力']);
    }    
    
    public function post(Request $request){
        $validate_rule=[
        'name'=>'required',//requiredは、
        'mail'=>'email',
        'age'=>'numeric|between:0,150',//numericは値が数値であるか、betweedは0〜150であるか
        ];
        //バリデーション処理。それぞれ上記の条件に引っかかなければ、下のviewが実行される
        $this->validate($request,$validate_rule);
        return view('hello.index',['msg'=>'正しく入力されました']);
    }
}