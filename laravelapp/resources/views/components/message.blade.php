{{--コンポーネントを作成。一部を切り離して作成して、組み込むため--}}
<html>
<head>
<title>@yield('title')</title> {{--@yieldを用意して、タイトルを表示するようにする--}}
<style>
.message{
    border:double 4px #ccc; 
    margin:10px;
    padding:10px;
    background-color:#fafafa;
}
.msg_title{
	margin:10px 20px;
	text-color:#999;
	font-size:16pt;
	font-weight:bold;
}
.msg_content{
	margin:10px 20px;
	text-color:#aaa;
	font-size:12pt;
}
</style>
</head>
<body>
<div class="message">
	<p class="msg_title">{{$msg_title}}</p>{{--index.bladeからslotで値が渡される--}}
	<p class="msg_content">{{$msg_content}}</p>
</body>
</html> 
