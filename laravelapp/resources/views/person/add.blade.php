{{--継承レイアウト--}}
{{--Eloquentのモデルを利用して、findメソッドでidからデータ検索--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Person.find') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	新規作成ページ
@endsection

@section('content')
	@if(count($errors)>0) {{--バリデーションのエラーがあったら--}}
	<div>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<table>
	<form action="/person/add" method="post">
	{{ csrf_field() }}
	<tr><th>name:</th><td><input type="text" name="name" value="{{old('name')}}"></td></tr>
	<tr><th>mail:</th><td><input type="text" name="mail" value="{{old('mail')}}"></td></tr>
	<tr><th>age:</th><td><input type="number" name="age" value="{{old('age')}}"></td></tr>
	<tr><th></th><td><input type="submit" value="send"></td></tr>
	</form>
	</table>
	<a href="/person">戻る</a>
	@endsection

	@section('footer')
	copyright 2017 tuyano.
	@endsection
