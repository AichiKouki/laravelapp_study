{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Index') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	インデックスページ
@endsection

@section('content')
<p>{{$msg}}</p>
{{--$errorはバリデーションで発生したエラーメッセージをまとめて管理するオブジェクト--}}
@if(count($errors)>0) {{--$errorはバリデーションの機能によって組み込まれている--}}
<p>入力に問題があります。再入力してください</p>
@endif
<table>
<form action="/hello" method="post">
	{{csrf_field()}}
	@if($errors->has('name')) {{--hasメソッドは、エラーがあるかどうかをチェック--}}
	<tr><th>ERROR</th><td>{{$errors->first('name')}}</td></tr>{{--firstメソッドは、指定した項目の最初のエラーメッセージを取得--}}
	@endif
	<tr><th>name:</th><td><input type="text" name="name" value="{{old('name')}}"></td></tr>
		@if($errors->has('mail'))
	<tr><th>ERROR</th><td>{{$errors->first('mail')}}</td></tr>
	@endif
	<tr><th>mail:</th><td><input type="text" name="mail" value="{{old('mail')}}"></td></tr>	
		@if($errors->has('age'))
	<tr><th>ERROR</th><td>{{$errors->first('age')}}</td></tr>
	@endif
	<tr><th>age:</th><td><input type="text" name="age" value="{{old('age')}}"></td></tr>
	<tr><th>name:</th><td><input type="submit" value="send"></td></tr>
</form>
</table>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection

<!--自作テンプレートを作成してみる-->
<!--MVCの表示の部分-->
<html>
<head>
<title>Hello/Index</title>
<style>
body{
	fontsize:16pt;
	color:#999;
}
h1{
	font-size:50pt;
	text-align:right;
	color:#f6f6f6;
	margin:-20px 0px -30px 0px;
	letter-spacing:-4pt;/*文字の間隔を指定する*/
}
</style>
</head>
<body>
<h1>Blade/Index</h1>

</ol>
</body>
</html> 
