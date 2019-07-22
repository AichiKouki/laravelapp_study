<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
//第一引数に、生成するモデルクラス、第二引数にクロージャを用意する。
//引数にはFaker/Generatorクラスのインスタンスが渡されて、これを利用してェイクデータを用意する。
$factory->define(App\User::class, function (Faker $faker) {
  //モデルに設定する各フィールドの値を連想配列にまとめてreturnする。
  //このreturnされた配列の値を使ってモデルが生成されて、データベースに保存される。
    return [
      //nameとmailはFaker/Generatorから受け取り、ageは乱数を使って値を設定
        'name' => $faker->name,
        'mail' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'age' => random_int(1,99),
    ];
});

$factory->define(App\Person::class, function (Faker $faker) {
  //モデルに設定する各フィールドの値を連想配列にまとめてreturnする。
  //このreturnされた配列の値を使ってモデルが生成されて、データベースに保存される。
    return [
      //nameとmailはFaker/Generatorから受け取り、ageは乱数を使って値を設定
        'name' => $faker->name,
        'mail' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'age' => random_int(1,99),
    ];
});
