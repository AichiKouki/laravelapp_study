<?php
//クライアントとサーバーの間をやりとりするため「Request」と「Response」
//今回は、「Request」と「Response」のオブジェクトを使ってみる程度
namespace App\Http\Controllers;

use Illuminate\Http\Request;//デフォルトで用意されていた
use Illuminate\Http\Response;//新しく追加

class RequestResponseController extends Controller
{
//RequestとResponseを引数に追加するだけでインスタンスが用意され、使えるようになる
    public function index(Request $request,Response $response){
    	$html= <<<EOF
<html>
<head>
<title>Hello</title>
<style>
body{
	fontsize:16pt;
	color:#999;
}
h1{
	font-size:100pt;
	text-align:right;
	color:#eee;
	margin:-40px 0px 50px 0px;
}
</style>
</head>
<body>
<h1>Hello</h1>
<h3>Request</h3>
<pre>{$request}</pre>//ヘッダー情報
<h3>Response</h3>
<pre>{$response}</pre>//キャッシュコントロールや日付などの情報が得られる
<p>これは、シングルアクションコントローラーのアクションです</p>
</body>
</html> 
EOF;
//setContentは、引数の値にコンテンツを変更する
$response -> setContent($html);//Responseのメソッド
return $response;
    }
}
/*
RequestとResponseの主なメソッド
〜Request〜(アクセスしたURLに関するものがいくつか用意されている)
$request -> url();
→urlは、アクセスしたURLを返します。ただし、クエリー文字列(アドレスの後につけられる、?abc=xyzというテキスト)は省略される

$request -> fullUrl();
→fullUrlは、アクセスしたアドレスを完全な形で返します(クエリー文字列も含まれます)

$request -> path()
→pathは、ドメイン下のパス部分だけを返します

〜Response〜(クライアントへ返送する際のステータスコード、表示コンテンツの設定などがあります)
$this -> status();
→アクセスに関するステータスコードを返します。これは正常にアクセスが終了していたら200になる

$this -> content();
→コンテンツの取得・設定を行うもの。contentはコンテンツを取得し、setContentは引数の値にコンテンツを変更します 
*/
