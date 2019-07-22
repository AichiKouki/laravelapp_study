{{--継承レイアウト--}}
{{--Eloquentのモデルを利用して、findメソッドでidからデータ検索--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Board.add') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	投稿ページ(存在しないperson idは入力しないでください)
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
	<form action="/board/add" method="post">
	{{ csrf_field() }}
	<tr><th>person id:</th><td><input type="number" name="person_id" value="{{old('person_id')}}"></td></tr>
	<tr><th>title:</th><td><input type="text" name="title" value="{{old('title')}}"></td></tr>
	<tr><th>message:</th><td><input type="text" name="message" value="{{old('message')}}"></td></tr>
	<tr><th></th><td><input type="submit" value="send"></td></tr>
	</form>
	</table>
	<a href="/board">戻る</a>
	@endsection

	@section('footer')
	copyright 2017 tuyano.
	@endsection
