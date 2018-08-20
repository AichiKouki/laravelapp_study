<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

//オリジナルのバリデータの作成のため
use Illuminate\Validation\Validator;
use App\Http\Validators\HelloValidator;

//サービスプロパイダを作成するためにServiceProviderクラスを継承
class HelloServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *アプリケーションが起動する際に割り込んで実行される処理がbootメソッド
     * @return void
     */
    public function boot()
    {
        $validator=$this->app['validator'];//バリデータは$this->app['validator']に保管されている
        //resolverというメソッドで、バリデーションの処理を行う設定ができます
        $validator->resolver(function($translator,$data,$rules,$messages){
            //HelloValidatorクラスのインスタンスをreturnすることで、このクラスをバリデーションの処理をして設定できます
            return new HelloValidator($translator,$data,$rules,$messages);
        });
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
