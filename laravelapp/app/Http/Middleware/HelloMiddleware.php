<?php
//ミドルウェア：リクエストがアクションに届く前や後に割り込んで処理を実行するもの
namespace App\Http\Middleware;//正しくnamespaceを指定しておかないと動かない

use Closure;//無名クラスを表すためのクラス

class HelloMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     //第一引数の$requestはRequestのインスタンスで、リクエストの情報を管理
     //第二引数の$nestはClosureクラスのインスタンスで、無名クラスを表すため。
    public function handle($request, Closure $next)
    {
        /*
        //ミドルウェアの前処理
        $data=[
        ['name'=>'taro','mail'=>'taro@yamada'],
        ['name'=>'hanako','mail'=>'hanako@flower'],
        ['name'=>'sachico','mail'=>'sachiko@happy']
        ];
        //mergeは、フォームの送信などで送られる値(inputの値)に新たな値を追加するものです。
        $request->merge(['data'=>$data]);//merge(配列)
        return $next($request);//渡された$nextはクロージャになっており、これを呼び出して実行することでミドルウェアからアプリケーションへと送られるRequestインスタンスを作成。コントローラーのアクションでindex(Request $request)　で受け取る
        */
        
        //ミドルウェアの後処理(レスポンスからクラインとに返送されるコンテンツを取り出し、その一部を置換して返送しています)
        $response=$next($request);//コントローラのアクションが実行され、その結果のレスポンスが変数$responseに入る
        $content=$response->content();//contentメソッドは、レスポンスに設定されているコンテンツが取得できる。これは送り返されるHTMLソースコードのテキストが入ってる
        //<middleware>というタグを使って、正規表現で置換する
        $pattern='/<middleware>(.*)<\/middleware>/i';
        
        $replace='<a href="http://$1">$1</a>';
        $content=preg_replace($pattern,$replace,$content);//middlewareタグをaタグに置換
        
        //レスポンスへのコンテンツ設定はsetContentメソッドを使う。これでクライアントに返送されるコンテンツが変更されました
        $response->setContent($content);
        return $response;//後はレスポンスをreturnするだけ
    }
}
