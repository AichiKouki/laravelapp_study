{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Person') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	削除ページ
@endsection

@section('content')
{{--フォームの入力にルール違反してたらエラー表示--}}
	@if(count($errors)>0)
	<div>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<table>
	<form action="/person/del" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="id" value="{{$form->id}}">
	<tr><th>name:</th><td><input type="text" name="name" value="{{$form->name}}"></td></tr>
	<tr><th>mail:</th><td><input type="text" name="mail" value="{{$form->mail}}"></td></tr>
	<tr><th>age:</th><td><input type="number" name="age" value="{{$form->age}}"></td></tr>
	<tr><th></th><td><input type="submit" value="send"></td></tr>
	</table>
	<a href="/person">戻る</a>
@endsection

@section('footer')
copyright 2017 tuyano.
@endsection
