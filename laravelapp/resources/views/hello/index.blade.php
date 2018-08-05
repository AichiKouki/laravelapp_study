{{--継承レイアウト--}}
@extends('layouts.helloapp') {{--layoutsフォルダのhelloapp〜のbladeテンプレートを継承--}}

@section('title','Index') {{--@yieldを使わず単純に「Index」という文字列を表示したいから--}}

@section('menubar') {{--親レイアウトにmenubarのyieldはない。つまりsectionを上書きした--}}
	@parent {{--上書きはするが親にあるセクションも残して表示したいからこれではめ込む--}}
	インデックスページ
@endsection

@section('content')
	<p>ここが本文のコンテンツです</p>
	<p>必要なだけ記述できます</p>
{{--コンポーネントを組み込む--}}
	@component('components.message') {{--componentsフォルダのmessageブレード--}}
		@slot('msg_title'){{--コンポーネントを利用するにはslotで値を渡す必要があるから--}}
		CAUTION！
		@endslot
		
		@slot('msg_content')
		これはメッセージの表示です。
		@endslot
	@endcomponent

{{--サブビュー。切り離したものをそのまま表示--}}
@include('components.message',['msg_title'=>'OK','msg_content'=>'サブメニューです'])

{{--@each。あらかじめ用意した配列やコレクションから順に値を取り出して指定のテンプレートにはめ込んで出力する--}}
	<p>ここが本文のコンテンツです</p>
	@each('components.item',$data,'item'){{--テンプレート名、配列、変数名--}}
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
