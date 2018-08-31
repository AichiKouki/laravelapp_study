<?php

namespace App\Http\Controllers;

use App\Person;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request){
    	//Illuminate\Database\Eloquent名前空間のCollectionクラスのインスタンスとして得られる
    	//一般的なコレクションと同様、foreachとかで取得可能
    	//一つ一つのレコードは全てPersonクラスのインスタンスとしてまとめられている
    	$items = Person::all();//これだけで、全レコードを取得できる
    	return view('person.index',['items'=>$items]);
    }
}
