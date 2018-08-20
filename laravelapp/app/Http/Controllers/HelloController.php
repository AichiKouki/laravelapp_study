<?php
//Bladeのテンプレートを使ってみるコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた

use App\Http\Requests\HelloRequest;//フォームリクエスト機能を使うため

use Validator;//バリデータを作成するため

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
    //Requestのqueryメソッドは送信されたクエリー文字列を配列の形にまとめたものを返す,  	
    $validator=Validator::make($request->query() , [
        'id'=>'required',
        'pass'=>'required',
    ]);
    if($validator->fails()){
        $msg='クエリーに問題があります';
    }else{
        $msg='ID/PASSを受け付けました。フォームを入力してください';
    }
    	return view('hello.index',['msg'=>$msg,]);
    }    
    
    //ここのコントローラーに来る前に、フォームの内部でフォームの内容をチェックしてある。
    //だから、HelloRequestに設定してる。
    public function post(Request $request){//RequestではなくHelloRequestを使う
    
    //バリデータを作成する
    $rules=[
            'name'=>'required',//入力必須
            'mail'=>'email',//メールアドレスの形式かどうか
            'age'=>'numeric|between:0,150',//numericは数値かどうか、betweenは0〜150の間か
    ];
    $messages=[
        'name.required'=>'名前は必ず入力してください',
        'mail.email'=>'メールアドレスが必要です',
        'age.numeric'=>'年齢を整数で記入してください',
        'age.between'=>'年齢は0〜150の間で入力してください',
    ];
    //makeというメソッドを使ってインスタンスを作成する必要がある
    //make(値の配列,ルールの配列)
    $validator = Validator::make($request->all(),$rules,$messages);
    //Validatorのインスタンスを作成したので、後はエラーが起きたかチェックして処理する
    if($validator->fails()){//failsはValidatorクラスにあるメソッドで、バリデーションチェックに失敗したかどうかを調べる
        return redirect('/hello')
        ->withErrors($validator)//Validatorで発生したエラーメッセージをリダイレクト先に引き継ぐ
        ->withInput();//送信されたフォームの値をそのまま引き継ぎます
    }
        return view('hello.index',['msg'=>'正しく入力されました']);
    }
}