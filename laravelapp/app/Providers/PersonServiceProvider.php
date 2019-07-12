<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

//オリジナルのバリデータの作成のため
use Illuminate\Validation\Validator;
use App\Http\Validators\PersonValidator;

//サービスプロパイダを作成するためにServiceProviderクラスを継承
class PersonServiceProvider extends ServiceProvider
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
            //PersonValidatorクラスのインスタンスをreturnすることで、このクラスをバリデーションの処理をして設定できます
            return new PersonValidator($translator,$data,$rules,$messages);
        });

        //extendメソッドを使って、フォームだけカスタマイズしたい！みたいなちょっとしたものなら、もっと簡単にルールが作れる
        $validator->extend('person_extend',function($attribute,$value,$parameters,$validator){
            return $value<1000;
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
