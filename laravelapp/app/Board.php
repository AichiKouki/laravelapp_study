<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/*
*このクラスはモデル。モデルとは、テーブル内容を定義したクラスです。
*Laravelではテーブル名は複数形、モデルは単数形という命名規則になっている。
*DBから取得するデータの一つ一つのレコードは全てPersonクラスのインスタンスだから、それぞれプロパティやメソッドを追加できる。
*モデルクラスのインスタンスだから、例えばクラスにプロパティやメソッドを追加することで独自に機能を拡張することができる。
*/
class Board extends Model
{
    protected $guarded = array('id');

  //基本的なバリデーションの設定情報
	public static $rules = array(
        'person_id' => 'required',
        'title' => 'required',
        'message' => 'required'
    );

    //従テーブル側から、関連づけられている主テーブルのレコードを取り出す
      public function person()
      {
          //belongsToメソッドを使うことにより、Personの情報が取り出せるようになる
          return $this->belongsTo('App\Person');
      }

    //データ内容をテキストで返すgetDataメソッド
    public function getData()
    {
      //ここはBoard.phpだが、上記のbelongToでPerson.phpのデータが使えるようになった。だから$this->personみたいに使うことができる。
      //まだ作成したいないユーザーidを指定して送信ボタンを押すと、以下の$this->person->nameが「non Object」となる
        //return $this->id . ': ' . $this->title;
       return $this->id . ': ' . $this->title . ' (' . $this->person->name . ')';
    }
}
