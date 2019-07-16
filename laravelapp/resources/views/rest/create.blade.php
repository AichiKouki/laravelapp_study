{{--他のコントロールから読み込まれるフォーム--}}
{{--フォームだけしか記述していないが、表示はされる--}}
<table>
<form action="/rest" method="post">
{{ csrf_field() }}
<tr><th>message:</th><td><input type="text" name="message" value="{{old('message')}}"></td></tr>
<tr><th>url:</th><td><input type="text" name="url" value="{{old('url')}}"></td></tr>
<tr><th></th><td><input type="submit" value="send"></td></tr>
</form>
</table>

	<a href="/person">戻る</a>
