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
	font-size:100pt;
	text-align:right;
	color:#eee;
	margin:-40px 0px 50px 0px;
}
</style>
</head>
<body>
<h1>Index</h1>
<p>This is a sample page with php-template.</p>
<!--msgは、コントローラ側で作った連想配列のキーの名前。合わせる必要がある-->
<p> <?php echo $msg; ?> </p><!--コントローラ側で値を渡したので受け取る-->
<p> <?php echo $msg2; ?> </p><!--コントローラ側で値を渡したので受け取る-->
<p> <?php echo date("Y年n月j日"); ?> </p><!--現在の日付を取得して表示-->
<p>ID= <?php echo $id; ?> </p><!--ルートパラメータをテンプレートに渡す-->
<p>ID= <?php echo $id_query_string; ?> </p><!--クエリ文字列を受け取る-->
</body>
</html> 
