<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*
*Laravelではテーブル名は複数形、モデルは単数形という命名規則になっている。
*モデルクラスのインスタンスだから、例えばクラスにプロパティやメソッドを追加することで独自に機能を拡張することができる。
*/
class Person extends Model
{
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
}
