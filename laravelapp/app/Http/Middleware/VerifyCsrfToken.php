<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *CSRF検証から除外されるべきURI。
     *CSRF対策を行なっているスクリプト(あらかじめ生成されている)
     * @var array
     */
     //このクラスでは標準で$exceptという変数が用意されていて、これがCSRF対策を提供しないアクションの配列
    protected $except = [
        'hello', //これで、/helloにPOST送信された際にはCSRF対策が実行されなくなります
    ];
}
