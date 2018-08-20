<?php
//フォームリクエスト
namespace App\Http\Requests;
//FormRequestはRequestを継承して作られていて、リクエストの機能をベースにして更にバリデーションなどのフォームの処理に関する機能が追加されている
use Illuminate\Foundation\Http\FormRequest;

class HelloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *このフォームリスエストを利用するアクションで、フォームリクエストの利用が許可されているかどうかを示すものです。戻り値としてtrueを返せば許可され、falseを返すと不許可になり、HttpExceptionという例外が発生してフォーム処理が行えなくなります
     *
     * @return bool
     */
    public function authorize()
    {
        //$this->pathでアクセスしたパスをチェックしている。パスがhelloだったらtrue。
        if($this->path() == 'hello'){//hello以外のパスでは利用できない
            return true;
        }else{
        return false;
        }
    }
    
    /**
     * Get the validation rules that apply to the request.
     *適用されているバリデーションの検証ルールを設定します。これは、先にコントローラーでvalidateメソッドを呼び出す際に第二引数に指定した、検証ルールの配列と同じものを用意し、returnします。ここでreturnされた検証ルールを元に、FormRequestでバリデーションチェックが実行されます
     * @return array
     */
    public function rules()
    {
        return [
            //これで、name、mail、ageの各フィールドにルールが適用されます
            'name'=>'required',//入力必須
            'mail'=>'email',//メールアドレスの形式かどうか
            'age'=>'numeric|between:0,150',//numericは数値かどうか、betweenは0〜150の間か
        ];
    }
    
        /*
    *エラーメッセージをカスタマイズ。
    *FormRequestの「messages」というメソッドをオーバーライドして使う
    *FormRequestのバリデーション機能がエラーメッセージを必要とした際にここが呼ばれる
    */
    public function messages()
    {
        return [
        'name.required'=>'名前は必ず入力してください',
        'mail.email'=>'メールアドレスが必要です',
        'age.numeric'=>'年齢を整数で記入してください',
        'age.between'=>'年齢は0〜150の間で入力してください',
        ];
    }
}
