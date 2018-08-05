<?php
//テンプレートを使ってみるコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた

class Use_template_Controller extends Controller
{
//コントローラでテンプレートを使ってみる
    public function index($id='zero'){//引数を用意して初期化
    	//viewの第二引数でテンプレートに値を渡す
    	$data=[
    	'msg'=>'これはコントローラから渡されたメッセージです',
    	'msg2'=>'これはコントローラから渡された2つ目のメッセージです',
    	'id'=>$id, //ルートパラメータが渡されるので、それを代入して、次にtemplateに渡す
    	'id_query_string'=>'query_string_sample'//クエリー文字列
    	];
    	//resources/views/hello/index.php、このテンプレートに値を渡してレンダリング
    	return view('hello.index',$data);//第一引数は、フォルダ名.ファイル名。第二引数はtemplateに渡す値となる連想配列
   
    }
    
    //クエリー文字列をパラメータとして利用する
    public function query_string(Request $request){//引数にRequestのインスタンスが必要
    	 $data=[
    	 'msg'=>'これはコントローラから渡されたメッセージです',
    	'msg2'=>'これはコントローラから渡された2つ目のメッセージです',
    	'id'=>'aichi', //クエリー文字列を試したいのでここでは固定
    	'id_query_string'=>$request->id//クエリ文字列の部分が、「?id=~」と書いてあったら
    	];
    	return view('hello.index',$data);
    }
}