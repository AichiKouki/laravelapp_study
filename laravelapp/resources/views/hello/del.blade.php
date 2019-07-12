{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Delete') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	削除ページ
@endsection

@section('content')
<table>
<form action="/hello/del" method="post">
{{csrf_field()}}
<input type="hidden" name="id" value="{{$form->id}}">
<tr><th>id:(今パスで指定しているid)</th><td>{{$form->id}}</td></tr>
<tr><th>name:</th><td>{{$form->name}}</td></tr>
<tr><th>name:</th><td>{{$form->mail}}</td></tr>
<tr><th>name:</th><td>{{$form->age}}</td></tr>
<tr><th>削除ボタン</th><td><input type="submit" value="実行"></td></tr>
</table>

<a href="/hello">戻る</a>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
