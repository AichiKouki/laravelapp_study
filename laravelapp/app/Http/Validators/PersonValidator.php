<?php
//オリジナルのバリデータの作成
namespace App\Http\Validators;

use Illuminate\Validation\Validator;

class PersonValidator extends Validator
{
	/*
	*validate◯◯◯という名前のメソッドを用意する必要がある
	*validateAbcなら、abcというルールとして扱われる
	@$attribute・・・設定したコントロール名
	@value・・・ッチェックする値
	@parameters・・・ルールに渡されるパラメータ
	:
	これらの値を元にバリデーションを行い、falseを返せばバリデーション時にエラーが発生したことを表す
	*/
	public function validateEvenNumber($attribute,$value,$parameters){//ageSizeLimitという名前でルールを定義
		return $value %2 == 0;
	}

//郵便番号のバリデーション。3桁-4桁の形式かどうか
	public function validatePostalCode(){ //postalCcodeという名前のルールを定義
		return true;//今は仮にtrueにしただけ。後ほどちゃんと実装
	}
}
