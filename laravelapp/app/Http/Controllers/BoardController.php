<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    //レコード一覧を表示する
    public function index(Request $request)
    {
        //$items = Board::all();//これだと、レコード一つ一つのPersonに関連づけされているBoardを取り出すということになり、レコードの数+1回DBにアクセスしていることになる。
        $items = Board::with('person')->get(); //with()を使うだけでレコードの取得の仕方が代わり、アクセスがたったの2回になる。
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
        $this->validate($request, Board::$rules);
        $board = new Board;
        $form = $request->all();
        unset($form['_token']);
        $board->fill($form)->save();
        return redirect('/board');
    }

}
