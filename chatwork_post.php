<?php
/**
 * Created by PhpStorm.
 * User: kawaguchinaoya
 * Date: 2019-01-14
 * Time: 01:38
 */
require './vendor/autoload.php';

//.envの保存場所指定（カレントに設定）
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$token   = getenv('TOKEN');
$room_id = getenv('ROOM');

// ヘッダ
header("Content-type: text/html; charset=utf-8");

$params = [
    "body" => "PHPからテスト投稿"
];

// cURLでPOST
$ch = curl_init();

$post_opt = [
    CURLOPT_URL => "https://api.chatwork.com/v2/rooms/{$room_id}/messages",
    CURLOPT_HTTPHEADER => ['X-ChatWorkToken: '. $token],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($params, '', '&')
];
curl_setopt_array( $ch, $post_opt );

$rsp = curl_exec($ch);
curl_close($ch);

// 送信結果も見ておく
$res = json_decode($rsp);
var_dump($res);