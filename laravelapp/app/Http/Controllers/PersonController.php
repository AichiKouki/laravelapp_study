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
    	$item = Person::nameEqual($request->input)->first();
    	$param = ['input' => $request->input , 'item' => $item];
    	return view('person.find',$param);
    }
}
