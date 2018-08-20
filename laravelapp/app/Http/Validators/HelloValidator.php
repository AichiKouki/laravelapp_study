<?php
//オリジナルのバリデータの作成
namespace App\Http\Validators;

use Illuminate\Validation\Validator;

class HelloValidator extends Validator
{
	/*
	*validate◯◯◯という名前のメソッドを用意する必要がある
	*validateAbcなら、abcというルールとして扱われる
	*/
	public function validateHello($attribute,$value,$parameters){//helloという名前のルールを定義
		return $value % 2 == 0;//入力された値が偶数なら許可、奇数なら不許可となるルール
	}
}
