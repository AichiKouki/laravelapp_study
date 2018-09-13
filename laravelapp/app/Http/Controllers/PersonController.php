<?php

namespace App\Http\Controllers;

use App\Person;

use Illuminate\Http\Request;

class PersonController extends Controller
{
	/*
    Illuminate\Database\Eloquent名前空間のCollectionクラスのインスタンスとして得られる
    一般的なコレクションと同様、foreachとかで取得可能
    一つ一つのレコードは全てPersonクラスのインスタンスとしてまとめられている
	*/
    public function index(Request $request){
    	$items = Person::all();//これだけで、全レコードを取得できる
    	return view('person.index',['items'=>$items]);
    }
    
    public function find(Request $request){
    	return view('person.find',['input'=>'']);
    }
    
    public function search(Request $request){
    	$min = $request->input*1;
    	$max = $min+10;
    	$item = Person::AgeGreaterThan($min)->AgeLessThan($max)->first();
    	$param = ['input' => $request->input , 'item' => $item];
    	return view('person.find',$param);
    }
    
    //モデルからレコード作成処理
    public function add(Request $request){
        return view('person.add');
    }
    public function create(Request $request){
        $this->validate($request,Person::$rules);//モデルの中のルールに基づいてチェック
        $person = new Person;//バリデーションを通過したら、いよいよ保存作業
        $form = $request->all();//フォームの値全て取得
        unset($form['__token']);//unsetで、csrf用の非表示フィールドはいらないので削除
        $person->fill($form)->save();//fillメソッドでフォームの値を全てのモデルの個々のプロパティにまとめて代入される。saveメソッドでデータベースに保存
        return redirect('/person');
    }
    
    //モデルからデータの更新処理を行う
    public function edit(Request $request){
        $person = Person::find($request->id);
        return view('person.edit',['form'=>$person]);
    }
    public function update(Request $request){
        $this->validate($request,Person::$rules);//バリデーション
        $person = Person::find($request->id);//idに基づいたレコード取得
        $form = $request->all();//フォームで送信されたデータ取得
        unset($form['__token']);//csrfの非表示フィールドは削除
        $person->fill($form)->save();//モデルの各プロパティに代入
        return redirect('/person');
    }
}
