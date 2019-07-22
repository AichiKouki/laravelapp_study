<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;

// 「storage/logs/laravel.log」の中に任意のログを出力させるため
use Log;

//ちょっとしたDB検索がしたい
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    //レコード一覧を表示する
    public function index(Request $request)
    {
        //$items = Board::all();//これだと、レコード一つ一つのPersonに関連づけされているBoardを取り出すということになり、レコードの数+1回DBにアクセスしていることになる。
        $items = Board::with('person')->get(); //with()を使うだけでレコードの取得の仕方が代わり、アクセスがたったの2回になる。
        Log::debug('投稿のとき、指定したperson_idは存在するかどうか'.$items);
        return view('board.index', ['items' => $items]);
    }
    //新規投稿のためのページを描画
    public function add(Request $request)
    {
        return view('board.add');
    }
    //新規投稿のための処理
    public function create(Request $request)
    {
      //バリデーション
        $this->validate($request, Board::$rules);
       //まず、入力されたperson_idが存在するかをチェック
        $person_items = DB::table('people')->where('id',$request->person_id)->first();
        if(is_null($person_items)){
        Log::debug('指定されたperson_idは存在しなかったのでDB処理せずにreturnする。');
        return redirect('/board/add')->withErrors('入力されたperson idは存在しません');
        }
        $board = new Board;
        $form = $request->all();
        unset($form['_token']);
        $board->fill($form)->save();
        return redirect('/board');
    }

}
