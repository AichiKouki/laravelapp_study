<!--ベース・レイアウト(このレイアウトをベースに、他のテンプレートはこれを継承する)-->
<!--MVCの表示の部分-->
<html>
<head>
<title>@yield('title')</title> {{--@yieldを用意して、タイトルを表示するようにする--}}
<style>
body{
	font-size:16pt;
	color:#999;
	margin:5px;
}
h1{
	font-size:50pt;
	text-align:right;
	color:#f6f6f6;
	margin:-20px 0px -30px 0px;
	letter-spacing:-4pt;/*文字の間隔を指定する*/
}
ul{
	font-size:12pt;
}
hr{
	margin:25px 100px;
	border-top:1px dashed #ddd; /*破線で表示される*/
}
.menutitle{
	font-size:14pt;
	font-weight:bold;
	margin:0px;
}
.content{
	margin:10px;
}
.footer{
	text-align:right;
	font-size:10pt;
	margin:10px;
	border-bottom:solid 1px #ccc;
	color:#ccc;
}

th{
	background-color:#999;
	color:fff;
	padding:5px; 10px;
}

td{
	border:solid 1px #aaa;
	color:#999;
	padding:5px 10px;
}
</style>
{{--Laravelが標準で用意しているこのスタイルを使うことで、ある程度デザインされた表示を作ることができる。--}}
<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
<h1>@yield('title')</h1>
@section('menubar')
<ul>
	<p class="menutitle">＊メニュー</p>
	<li>@show</li> {{--ベースとなるレイアウトの場合、@sectionはこの終わり方をする--}}
</ul>
<hr size="1">
<div class="content">
@yield('content')
</div>
<div class="footer">
@yield('footer')
</div>
</body>
</html>
