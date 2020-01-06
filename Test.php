<?php
/**
 *   ┏┓　　　┏┓
 * ┏┛┻━━━┛┻┓
 * ┃　　　　　　　┃
 * ┃　　　━　　　┃
 * ┃　＞　　　＜　┃
 * ┃　　　　　　　┃
 * ┃...　⌒　...　┃
 * ┃　　　　　　　┃
 * ┗━┓　　　┏━┛
 *     ┃　　　┃　
 *     ┃　　　┃
 *     ┃　　　┃
 *     ┃　　　┃  神兽保佑
 *     ┃　　　┃  代码无bug　　
 *     ┃　　　┃
 *     ┃　　　┗━━━┓
 *     ┃　　　　　　　┣┓
 *     ┃　　　　　　　┏┛
 *     ┗┓┓┏━┳┓┏┛
 *       ┃┫┫　┃┫┫
 *       ┗┻┛　┗┻┛
 * Created by PhpStorm.
 * User: wanglifu
 * Date: 2020/1/6
 * Time: 17:09
 * Notes:
 */
require_once './vendor/autoload.php';
$config = [
    'app_id'=> 'bed1335956aa0f0e',
    'app_secret'=> 'fa4c4d7e0162a692a81db20a15da81ca',
];
$token = \Banyiyi\Client\AccessTokenClient::instance($config);
var_dump($token->refreshToekn());


/*$BlockchainClient = \Banyiyi\Client\BlockchainClient::instance($config);
$key = $BlockchainClient->getKey('123');*/