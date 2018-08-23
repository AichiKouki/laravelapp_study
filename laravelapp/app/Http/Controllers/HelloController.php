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
            $items=DB::select('select * from people');//レコードの値をオブジェクトにまとめた配列
    	    return view('hello.index',['items'=>$items]);
    }        
    //ここのコントローラーに来る前に、フォームの内部でフォームの内容をチェックしてある。
    //だから、HelloRequestに設定してる。
    public function post(Request $request){
            $items=DB::select('select * from people');//レコードの値をオブジェクトにまとめた配列
            return view('hello.index',['items'=>$items]);
    }
    //hello/addにアクセスしたら
    public function add(Request $request){
        return view('hello.add');
    }
    
    //インサート文でレコード作成
    public function create(Request $request){
        $param=[
            'name'=>$request->name,
            'mail'=>$request->mail,
            'age'=>$request->age,
        ];
        //プレースホルダでパラメータ結合
        DB::insert('insert into people (name,mail,age) values (:name,:mail,:age)',$param);
        return redirect('/hello');
    }
    //更新ページにアクセスした際
    public function edit(Request $request){
        return view('hello.edit');
    }
    
    //更新ページで送信ボタンが押されたら
    public function update(Request $request){
        $param=[
            'id'=>$request->id,
            'name'=>$request->name,
            'mail'=>$request->mail,
            'age'=>$request->age,
        ];
        DB::update('update people set name=:name,mail=:mail,age=:age where id=:id',$param);
        return redirect('/hello');
    }
    
    //レコード削除 
    public function del(Request $request){
        $param=['id'=>$request->id];
        $item=DB::select('select * from people where id= :id',$param);
        return view('hello.del',['form'=>$item[0]]);
    }
    
    public function remove(Request $request){
        $param=['id'=>$request->id];
        DB::delete('delete from people where id= :id',$param);
        return redirect('/hello');
    }
    
}