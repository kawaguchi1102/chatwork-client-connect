<?php
/**
 * Created by PhpStorm.
 * User: kawaguchinaoya
 * Date: 2019-01-14
 * Time: 02:22
 */
require './vendor/autoload.php';

//.envの保存場所指定（カレントに設定）
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$token   = getenv('TOKEN');
$room_id = getenv('ROOM');

// ヘッダ
header('Access-Control-Allow-Origin: *');
header("Content-type: text/html; charset=utf-8");

$params = [
    "body" => "PHPからテスト投稿"
];

// cURLでPOST
$ch = curl_init();

$member_get_opt = [
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_URL => "https://api.chatwork.com/v2/rooms/{$room_id}/members",
    CURLOPT_HTTPHEADER => ['X-ChatWorkToken: '. $token],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
];
curl_setopt_array( $ch, $member_get_opt );

$rsp = curl_exec($ch);
curl_close($ch);

// 送信結果も見ておく
$res = json_decode($rsp);

// json変換
echo json_encode($res);