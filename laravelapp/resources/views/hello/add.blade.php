{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Add') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	新規作成ページ
@endsection

@section('content')
<table>
<form action="/hello/add" method="post">
{{csrf_field()}}
<tr><th>name:</th><td><input type="text" name="name"></td></tr>
<tr><th>mail:</th><td><input type="text" name="mail"></td></tr>
<tr><th>age:</th><td><input type="text" name="age"></td></tr>
<tr><th></th><td><input type="submit" value="send"></td></tr>
</table>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection