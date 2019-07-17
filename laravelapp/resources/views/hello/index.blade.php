{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}
<style>
.pagination{
	font-size: 10pt;
}
.pagination li{
display:inline-block;
}
tr th a:link{
	color:white;
}
tr th a:visited{
	color:white;
}
tr th a:hover{
	color:white;
}
tr th a:active{
	color:white;
}
</style>
@section('title','Index') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	インデックスページ
@endsection

@section('content')
@if (Auth::check())
<p>USER:{{$user->name . '('.$user->email.')'}}</p>
@else
<p>＊ログインしていません。(<a href="/login">ログイン</a> | <a href="/register">登録</a>)</p>
@endif
<table>
<tr><th>ID</th><th><a href="/hello?sort=name">Name</a></th><th><a href="/hello?sort=mail">Mail</a></th><th><a href="/hello?sort=age">Age</a></th><th>最終更新日時</th><th>削除ボタン</th><tr>
{{--データベースから取得したい値を順に取り出しを--}}
		@foreach($items as $item)
			<tr>
				<td><a href="/hello/edit?id={{$item->id}}">{{$item->id}}</a></td>
				<td>{{$item->name}}</td>
				<td>{{$item->mail}}</td>
				<td>{{$item->age}}</td>
				<td>{{$item->updated_at}}</td>
				<td><a href="/hello/del?id={{$item->id}}">削除</a></td>
			</tr>
			@endforeach
</table>
{{--simplePeginateの戻り値には、前後のページに移動するリンク情報が含まれており、移動はそれらを使って作成されたリンクで行うようになっている。--}}
{{-- « Previous  Next » というリンクが自動で生成される。これで、ページングが可能となる。 --}}
{{$items->appends(['sort' => $sort])->links()}}   {{--appendsメソッドは、生成するリンクにパラメータを追加する。--}}
<a href="/hello/add">ユーザー新規作成</a>
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
