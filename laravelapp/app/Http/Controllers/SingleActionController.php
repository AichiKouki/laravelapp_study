<?php
//複数アクションを用意するのとは反対に、「1つのコントローラーに1つんアクションだけしか利用しない」というような設計をする場合がある。
//このような場合には、シングルアクションコントローラーとしてクラスを用意する
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleActionController extends Controller
{
    //一般的なアクションメソッドの代わりに「__invoke」というメソッドを使って処理を実装
    public function __invoke(){
    	return<<<EDF
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
<h1>Single Action</h1>
<p>これは、シングルアクションコントローラーのアクションです</p>
</body>
</html> 
EDF;
    }
}
