<?php
//Bladeのテンプレートを使ってみるコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた

use Illuminate\Http\Response;

use App\Http\Requests\HelloRequest;//フォームリクエスト機能を使うため

use Validator;//バリデータを作成するため

use Illuminate\Support\Facades\DB;//データベースアクセス機能のDBクラスを利用するため

class HelloController extends Controller
{
//コントローラからBladeテンプレートを使う
    /*
    *resources/views/hello/index.phpにある。このテンプレートに値を渡してレンダリング
    *['msg'=>'メッセージ']
    *$msg   ←テンプレートでは上記のように連想配列のキーと同じ名前で受け取れる
    *viewメソッドの第一引数は、フォルダ名.ファイル名。第二引数はtemplateに渡す値となる連想配列
    */

    /*
    ブレードが優先されて描画される。
    例えば。index.phpとindex.blade.phpがあるとすれば、indexのブレードが存在するので、index.blade.phpが描画される
    もし「index.blade.php」がなければ、indexx.phpが描画される。
    */
    public function index(Request $request){//helloにアクセスした時のアクション
            $items=DB::table('people')->get();
    	    return view('hello.index',['items'=>$items]); //helloフォルダのindex.phpのテンプレートを描画
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
        //それぞれinputフィールドのnameから値を取得してそれを連想配列にする
        $param=[
            'name'=>$request->name,
            'mail'=>$request->mail,
            'age'=>$request->age,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        //プレースホルダでパラメータ結合
        //DB::insert('insert into people (name,mail,age) values (:name,:mail,:age)',$param);
        DB::table('people')->insert($param);
        return redirect('/hello');
    }
    //更新ページにアクセスした際
    public function edit(Request $request){
        $item=DB::table('people')->where('id',$request->id)->first();
        return view('hello.edit',['form'=>$item]);
    }

    //更新ページで送信ボタンが押されたら
    public function update(Request $request){
        $param=[
            'id'=>$request->id,
            'name'=>$request->name,
            'mail'=>$request->mail,
            'age'=>$request->age,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        //DB::update('update people set name=:name,mail=:mail,age=:age where id=:id',$param);
        DB::table('people')->where('id',$request->id)->update($param);
        return redirect('/hello');
    }

    //レコード削除
    public function del(Request $request){
        $param=['id'=>$request->id];
        //$item=DB::select('select * from people where id= :id',$param);
        $item=DB::table('people')->where('id',$request->id)->first();
        return view('hello.del',['form'=>$item]);
    }

    public function remove(Request $request){
        $param=['id'=>$request->id];
        //DB::delete('delete from people where id= :id',$param);
        DB::table('people')->where('id',$request->id)->delete();
        return redirect('/hello');
    }

    //詳細ページ
    public function show(Request $request){
        $min=$request->min;
        $max=$request->max;
        $items=DB::table('people')
        ->whereRaw('age>=? and age<=?',[$min,$max])->get();
        return view('hello.show',['items'=>$items]);
    }

}
