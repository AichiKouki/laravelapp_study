<?php

namespace App\Http\Controllers;

use App\Person;

use Illuminate\Http\Request;

use App\Http\Requests\PersonRequest;
use App\Http\Validator\PersonValidator;

class PersonController extends Controller
{
	/*
    Illuminate\Database\Eloquent名前空間のCollectionクラスのインスタンスとして得られる
    一般的なコレクションと同様、foreachとかで取得可能
    一つ一つのレコードは全てPersonクラスのインスタンスとしてまとめられている
	*/

  //トップページを描画するアクション。DBのPersonテーブルのデータを全て取得する。
    public function index(Request $request){
      //これだけで、全レコードを取得できる
    	//$items = Person::all();//取得されたレコードは、Illuminate\Database\Eqoquant名前空間のCollectionクラスのインスタンスとして得られます
      $hasItems = Person::has('boards')->get();
      $noItems = Person::doesntHave('boards')->get();
      $param = ['hasItems' => $hasItems,'noItems' => $noItems];
    	//return view('person.index',['items'=>$param]);
      return view('person.index',$param);
    }

    //IDによる検索するページを描画するアクション
    public function find(Request $request){
    	return view('person.find',['input'=>'']);
    }
    //IDによる検索処理を行うアクション
    public function search(Request $request){
    	$min = $request->input*1;
    	$max = $min+10;
    	$item = Person::AgeGreaterThan($min)->AgeLessThan($max)->first();//where::where()でもいいが、どうせならスコープを使った検索を行う
    	$param = ['input' => $request->input , 'item' => $item];
    	return view('person.find',$param);
    }

    //新規作成ページの描画のみ
    public function add(Request $request){
        return view('person.add');
    }

    //実際に追加処理を行うアクション
    public function create(PersonRequest $request){
      echo "ここまで実行";
        $this->validate($request,Person::$rules);//モデルの中のルールに基づいてチェック
        $person = new Person;//バリデーションを通過したら、いよいよ保存作業
        $form = $request->all();//フォームの値全て取得
        unset($form['__token']);//unsetで、csrf用の非表示フィールドはいらないので削除
        $person->fill($form)->save();//fillメソッドでフォームの値を全てのモデルの個々のプロパティにまとめて代入される。saveメソッドでインスタンスを保存
        return redirect('/person');
    }

    //更新処理をするページを描画するのみのアクション
    public function edit(Request $request){
        $person = Person::find($request->id);
        return view('person.edit',['form'=>$person]);
    }
    //モデルからデータの更新処理を行う
    public function update(Request $request){
        $this->validate($request,Person::$rules);//バリデーション
        $person = Person::find($request->id);//idに基づいたレコード取得
        $form = $request->all();//フォームで送信されたデータ取得
        unset($form['__token']);//csrfの非表示フィールドは削除
        $person->fill($form)->save();//モデルの各プロパティに代入
        return redirect('/person');
    }
    //モデルからレコードの削除処理を行う
    public function delete(Request $request){
        $person = Person::find($request->id);//idに基づいてモデルからレコード取得
        return view('person.del',['form'=>$person]);
    }
    public function remove(Request $request){
       //idによる検索が可能なfind()を使ってレコードを取得して、そのレコードに対してdelte()を呼び出すだけ
        Person::find($request->id)->delete();
        return redirect('/person');
    }
}
