<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/*
*グローバルスコープを作成する際に、モデルクラスの中にクロージャとして追加するのではなく、スコープのクラスを作成した方が、モデルから切り離され、特定のモデルに囚われず、汎用的な処理を行うスコープが作成できます
*/
class ScopePerson implements Scope
{
    /*
    *Scopeクラスでは、applayというメソッドを一つ用意する。
    *このメソッドでは、BuilderとModelがインスタンスとして渡される。なので、特定のモデルに縛られず、汎用的な処理ができる
    */
    public function apply(Builder $builder,Model $model){
        $builder->where('age','>',0);
    }
}
