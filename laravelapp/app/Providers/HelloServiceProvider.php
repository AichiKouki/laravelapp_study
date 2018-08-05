<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
//
class HelloServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *アプリケーションが起動する際に割り込んで実行される処理がbootメソッド
     * @return void
     */
    public function boot()
    {
        //ここでは、helloフォルダにあるindexブレードにview_messageという値を設定する処理
        //View::composerというメソッドは、ビューコンポーザーを設定するためのもの
        View::composer(//第一引数はビューの指定。第二引数は関数またはクラス
        'hello.index','App\Http\Composers\HelloComposer'
        );
    }

    /**
     * Register services.
     *必要なサービスの登録を行うためのもの
     * @return void
     */
    public function register()
    {
        //
    }
}
