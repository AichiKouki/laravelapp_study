{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Person') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	インデックスページ
@endsection

@section('content')
<h2>メッセージを投稿しているユーザーの一覧</h2>
<table>
<tr><th>ID</th><th>Name</th><th>Mail</th><th>Age</th><th>最終更新日時</th><th>Board</th><th>削除</th><tr>
{{--データベースから取得したい値を順に取り出し。ORMにより変換されて取得したレコードはCollection型のものなので、順番に取り出す--}}
		@foreach($hasItems as $item)
			<tr>
				<td><a href="/person/edit?id={{$item->id}}">{{$item->getData()}}</a></td> {{--getDataはPerson.phpで作った関数。nameの値とageの値を文字列連結して「愛知(22)」みたいな値を取得してる--}}
				<td>{{$item->name}}</td>
				<td>{{$item->mail}}</td>
				<td>{{$item->age}}</td>
				<td>{{$item->updated_at}}</td>
				<td>
				@if ($item->boards != null)
				<table width="100%">
					{{--Person.phpでboardメソッド作ってboardsテーブルを使えるようになったから、$item->boardsという書き方ができる。--}}
					@foreach($item->boards as $obj)
					<tr><td>{{$obj->getData()}}</td></tr>
					@endforeach
				</table>
				@endif
			</td>
				<td><a href="/person/del?id={{$item->id}}">削除</a></td>
			</tr>
			@endforeach
</table>

<h2>メッセージを一度も投稿していないユーザーの一覧</h2>
<table>
<tr><th>ID</th><th>Name</th><th>Mail</th><th>Age</th><th>最終更新日時</th><th>削除</th><tr>
{{--データベースから取得したい値を順に取り出し。ORMにより変換されて取得したレコードはCollection型のものなので、順番に取り出す--}}
		@foreach($noItems as $item)
			<tr>
				<td><a href="/person/edit?id={{$item->id}}">{{$item->getData()}}</a></td> {{--getDataはPerson.phpで作った関数。nameの値とageの値を文字列連結して「愛知(22)」みたいな値を取得してる--}}
				<td>{{$item->name}}</td>
				<td>{{$item->mail}}</td>
				<td>{{$item->age}}</td>
				<td>{{$item->updated_at}}</td>
				<td><a href="/person/del?id={{$item->id}}">削除</a></td>
			</tr>
			@endforeach
</table>
<a href="/person/add">ユーザ新規作成</a>
<br>
<a href="/person/find">ユーザ検索</a>
<br>
<a href="/board">メッセージ投稿</a>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection

<!--自作テンプレートを作成してみる-->
<!--MVCの表示の部分-->
<html>
<head>
<title>Person/Index</title>
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
