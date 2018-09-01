{{--継承レイアウト--}}
{{--Eloquentのモデルを利用して、findメソッドでidからデータ検索--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Person.find') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	検索ページ
@endsection

@section('content')
<form action="/person/find" method="post">
{{ csrf_field() }}
<input type="text" name="input" value="{{$input}}">
<input type="submit" value="find">
</form>
@if(isset($item))
<table>
<tr><th>ID</th><th>Name</th><th>Mail</th><th>Age</th><tr>
	<td>{{$item->getData()}}</td>
</table>
@endif
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
