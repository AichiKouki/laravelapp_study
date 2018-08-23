<?php
//Bladeのテンプレートを使ってみるコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた

use Illuminate\Http\Response;

use App\Http\Requests\HelloRequest;//フォームリクエスト機能を使うため

use Validator;//バリデータを作成するため

use Illuminate\Support\Facades\DB;//データベースアクセス昨日のDBクラスを利用するため

class HelloController extends Controller
{
//コントローラからBladeテンプレートを使う
    /*
    *resources/views/hello/index.phpにある。このテンプレートに値を渡してレンダリング
    *['msg'=>'メッセージ']
    *$msg   ←テンプレートでは上記のように連想配列のキーと同じ名前で受け取れる	
    *viewメソッドの第一引数は、フォルダ名.ファイル名。第二引数はtemplateに渡す値となる連想配列
    */
    public function index(Request $request){//helloにアクセスした時のアクション  
        if(isset($request->id)){
            $param=['id'=>$request->id];
            //プレースホルダでパラメータの結合(:idの部分がプレースホルダで第二引数をはめ込む)
            $items=DB::select('select * from people where id=:id',$param);//レコードの値をオブジェクトにまとめた配列
        }else{
            $items=DB::select('select * from people');
        }
    	return view('hello.index',['items'=>$items]);
    }    
    
    //ここのコントローラーに来る前に、フォームの内部でフォームの内容をチェックしてある。
    //だから、HelloRequestに設定してる。
    public function post(Request $request){
        $validate_rule=[
            'msg'=>'required',
        ];
        //バリデーション
        $this->validate($request,$validate_rule);
        $msg=$request->msg;//nameがmsgのフォームの値を取り出す
        $response=new Response(view('hello.index',['msg'=>$msg.'をクッキーに保存しました']));
        $response->cookie('msg',$msg,100);
        return $response;
        //return view('hello.index',['msg'=>$msg.'をクッキーに保存しました']);//これでもオッケー
    }
}