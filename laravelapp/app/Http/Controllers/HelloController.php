<?php
//Bladeのテンプレートを使ってみるコントローラ
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた

use Illuminate\Http\Response;

use App\Http\Requests\HelloRequest;//フォームリクエスト機能を使うため

use Validator;//バリデータを作成するため

use Illuminate\Support\Facades\DB;//データベースアクセス機能のDBクラスを利用するため

use App\Person;//ペジネーションで使う

//ユーザー認証と、authで使う
use Illuminate\Support\Facades\Auth;


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
      //Auth::userは、ログインしているユーザーのモデルインスタンス(AuthではUserというモデルクラスが用意されている)
      $user = Auth::user();//ログインしていなければnullとなる。もしnullではなかったら「index.blade.php」でのログインユーザー名の表示が可能になる
      $sort = $request->sort;//sort = ◯ ◯と渡されたフィールド名でレコードを並び替える
      $items = Person::orderBy($sort,'asc')->paginate(5);
      $param = ['items' => $items,'sort' => $sort,'user' => $user];
    	//return view('hello.index',['items'=>$items]); //helloフォルダのindex.phpのテンプレートを描画
      return view('hello.index',$param);
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

    //rest.blade.phpを表示するだけのアクション
    public function rest(Request $request){
      return view('hello.rest');
    }

    //セッションの値を取得するアクション
    public function ses_get(Request $request){
      //セッションから「msg」という値を取り出している
      $sesdata = $request->session()->get('msg');
      //セッションから取り出した値を「session_data」という名前でテンプレートに渡している。
      return view('hello.session',['session_data' => $sesdata]);
    }

    //セッションを登録するアクション
    public function ses_put(Request $request){
      $msg = $request->input;//inputタグのname属性がinputなので、普通に値を取り出す
      //これで、$msgの値が「msg」という名前でセッションに保管されます。
      $request->session()->put('msg',$msg);
      return redirect('hello/session');
    }

    //独自のログイン処理を行う際のフォームを描画するだけのアクション
    public function getAuth(Request $request){
      $param = ['message' => 'ログインしてください'];
      return view('hello.auth',$param);
    }

    //独自のログイン処理を行うためのあくしょん
    public function postAuth(Request $request){
      //フォームから普通にメールアドレスとパスワード取得して、if文でログイン処理行うだけ
      $email = $request->email;
      $password = $request->password;
      //ログイン判定(attemptメソッドにメールアドレスとパスワードを与えるだけで、ログイン判定ができる。)
      if(Auth::attempt(['email' => $email,'password' => $password])){
        $msg = 'ログインしました。('.Auth::user()->name.')';
      }else{
        $msg = 'ログインに失敗しました。';
      }

      return view('hello.auth',['message' => $msg]);//getAuthは、ここにある連想配列を一つの変数に入れていただけで同じ。
    }

}
