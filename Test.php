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

use Banyiyi\Client\AccessTokenClient;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Adapter\MemcachedAdapter;

require_once './vendor/autoload.php';
$config = [
    'app_id'=> 'bed1335956aa0f0e',
    'app_secret'=> 'fa4c4d7e0162a692a81db20a15da81ca',
];
/*$token = \Banyiyi\Client\AccessTokenClient::instance($config);
var_dump($token->refreshToekn());*/


/*$BlockchainClient = \Banyiyi\Client\BlockchainClient::instance($config);
$key = $BlockchainClient->getKey('123');*/


//redis 使用
/*$client = RedisAdapter::createConnection('redis://127.0.0.1');
$cache = new RedisAdapter($client);
AccessTokenClient::instance($config)->setCache($cache);*/

//MemcachedAdapter  Memcached > 2.0
/*$client = MemcachedAdapter::createConnection('memcache://127.0.0.1');
$cache = new MemcachedAdapter($client, $namespace = '', $defaultLifetime = 0);
AccessTokenClient::instance($config)->setCache($cache);*/