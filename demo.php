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
 * Date: 2019/12/26
 * Time: 17:09
 * Notes:
 */
require_once './vendor/autoload.php';
/*require_once 'banyiyi/src/Token/AccessTokenClient.php';
$config = [
    'app_id'=> '5e11840ad3cc29',
    'app_secret'=> 'ssssssssssssssssssssssssssssssss',
];
$token = \Banyiyi\Client\AccessTokenClient::instance($config);
var_dump($token->getToken());*/

require_once 'banyiyi/src/Blockchain/BlockchainClient.php';

$config = [
    'app_id'=> '5e11840ad3cc29',
    'app_secret'=> 'ssssssssssssssssssssssssssssssss',
];
$Blockchain = \Banyiyi\Client\BlockchainClient::instance($config);
$Blockchain->getKey();