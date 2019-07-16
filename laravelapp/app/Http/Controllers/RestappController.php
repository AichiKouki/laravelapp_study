<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restdata;

use Log;

/*
*コマンドでコントローラーを作るとき、コマンドのオプションとして「-resource」をつけた。
これをつけると、createやupdate、deleteなどが書かれたコントローラーが生成される。
だから、これはリソースコントローラーと呼ぶ。
*/

class RestappController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      Log::debug('ログのテスト。indexが呼ばれた');
        //Laravelでは、アクションメソッドの中で配列をreturnすると、自動的にその配列データをJSON景色に変換して出力してくれる。
        $items = Restdata::all();
        return $items->toArray();//toArrayメソッドを使って配列の形でレコード情報を取り出し、それをreturnするだけでJSON形式で出力される。
        //$msg = $request->session()->get('msg');
        //return $msg;
    }

    /**
     * Show the form for creating a new resource.
     *RESTfulには必要のないメソッド。「/rest」のパスでPOST送信したら、storeメソッドが呼ばれる。
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restdata = new Restdata;
        $form = $request->all();//フォームの値を全て取得
        unset($form['_token']);//unsetで、csrf用の非表示フィールドはいらないので削除
        $restdata->fill($form)->save();//fillメソッドでフォームの値を全てのモデルの個々のプロパティにまとめて代入される。saveメソッドでインスタンスを保存
        return redirect('/rest');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      Log::debug('RestappControllerのshowが呼ばれた');
      Log::debug('$idの値は'.$id);//http://127.0.0.1:8000/rest/8/  なら「8」が取得できる。
        $item = Restdata::find($id);
        $request->session()->put('msg', $item->message);
        return 'session "' . $request->session()->get('msg') . '" saved.';
        //return $item->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     * RESTfulには必要のないメソッド
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('rest.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Log::debug('RestappControllerのupdateが呼ばれた');
        $restdata = new Restdata;
        $person = RestData::find($id);//idに基づいたレコード取得
        $form = $request->all();//フォームで送信されたデータ取得
        unset($form['__token']);//csrfの非表示フィールドは削除
        $restdata->fill($form)->save();//モデルの各プロパティに代入
        return redirect('/person');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
