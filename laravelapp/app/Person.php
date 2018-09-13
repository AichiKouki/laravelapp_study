<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

use App\Scopes\ScopePerson;

/*
*Laravelではテーブル名は複数形、モデルは単数形という命名規則になっている。
*モデルクラスのインスタンスだから、例えばクラスにプロパティやメソッドを追加することで独自に機能を拡張することができる。
*/
class Person extends Model
{
    //モデルを利用してレコードを追加するための処理
    protected $guarded = array('id');//idを、値を用意しておかない項目として設定
    //バリデーションのルールをまとめた
    public static $rules = array(
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer|min:0|max:150'
    );
    
    //id、name、ageを文字列にして返します
    public function getData(){
    	return $this->id.':'.$this->name.'('.$this->age.')';
    }
    /*
    *スコープ(あらかじめ特定の条件を設定する処理を用意)を実装
    *「NameEqual」で呼び出せば、第一引数はnameを指定した名前に絞り込んだビルダが得られるので、呼び出す際は第一引数は指定しない。
    */
    public function scopeNameEqual($query,$str){
    	return $query->where('name',$str);//この条件で実行した結果を返す
    }
    
    /*
    *スコープ。
    *「〜以上、〜以下」の条件をあらかじめ設定
    */
    //ageの値が引数の値以上のレコードを取得
    public function scopeAgeGreaterThan($query,$n){
    	return $query->where('age','>=',$n);
    }
    
    //ageの値が引数の値以下のレコードを取得
    public function scopeAgeLessThan($query,$n){
    	return $query->where('age','<=',$n);//ageの値が引数の値以下のレコードを取得
    }    
    
    //グローバルスコープを作成
    /*
    *処理の組み込みは、モデルが作成される際の初期化処理として実行される。
    *bootというモデルの初期化専用のメソッドを用いる。
    */
    protected static function boot(){//bootという名前が決まっているメソッド
    	parent::boot();//初期化処理
    	//addGlobalScopeは、グローバルスコープを追加するためのメソッド
    	static::addGlobalScope(new ScopePerson);//ScopePersonがグローバルスコープとして追加
    }
}
