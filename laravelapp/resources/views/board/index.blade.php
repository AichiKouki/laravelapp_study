{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Board.index') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	ボード・ページ
@endsection

@section('content')
<table>
<tr><th>Title</th><th>メッセージ</th><tr>
{{--データベースから取得したい値を順に取り出し。ORMにより変換されて取得したレコードはCollection型のものなので、順番に取り出す--}}
{{--Person.phpでboardメソッド作ってboardsテーブルを使えるようになったから、$item->boardsという書き方ができる。--}}
		@foreach($items as $item)
			<tr>
				<td>{{$item->getData()}}</td>
				<td>{{$item->message}}</td>
			</tr>
			@endforeach
</table>
<a href="/board/add">メッセージの新規投稿</a>
<br>
<a href="/person">ユーザーの一覧</a>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection

<!--自作テンプレートを作成してみる-->
<!--MVCの表示の部分-->
<html>
<head>
<title>Board/Index</title>
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
