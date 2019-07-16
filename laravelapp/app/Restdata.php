<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restdata extends Model
{
    //EqoquantではDBのテーブル名はモデル名の複数形だが、今回は「restdata」という名前で単数形か複数形か分かりにくくなっているので、
    //ここで$tableを使ってテーブル名を指定して「restdata」テーブルを使うように指定
    protected $table = 'restdata';//テーブル名を指定
    protected $guarded = array('id');//保護されるフィールド。このフィールドには値は入れないから

    public static $rules = array(
      'message' => 'required',
      'url' => 'required'
    );

    public function getData(){
      return $this->id.':'.$this->message.'('.$this->url.')';
    }
}
