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
}
