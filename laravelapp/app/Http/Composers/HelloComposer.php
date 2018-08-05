<?php
//独立したクラスとしてビューコンポーザを用意する
//ビューコンポーザとは、ビューをレンダリングする際に自動的に実行される処理を用意するための部品です
namespace App\Http\Composers;

use Illuminate\View\View;

class HelloComposer
{
    //Viewインスタンスを引数として持っており、サービスプロパイダのbootからView::composerが実行された際に呼び出されます
    public function compose(View $view){//Viewクラスのインスタンスはビューを管理するもの
    //withメソッドはビューに変数などを追加するもの
    //getName()メソッドは、ビューの名前を取得してview_messageに設定してる
        $view->with('view_message','this view is"'.$view->getName().'"!!');
    }    
}