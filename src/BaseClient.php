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
 * Time: 11:50
 * Notes:
 */

namespace Banyiyi;

use Banyiyi\Client\AccessTokenClient;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\AggregateException;

class BaseClient extends Qequest
{
    private $token = '';

    protected $config = [];

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @param bool $returnRaw
     * @return mixed|string|void
     * 请求
     */
    public function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        $this->options = [
            'token' => $this->getToken(),
            'sign' => $this->getSign()
        ];

        if ($options) {
            $this->config = array_merge($this->config, $options);
        }

        try {
            $client = new Client();
            $response = $client->request($method, $url, $this->config);
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (AggregateException $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * 获取token
     */
    private function getToken()
    {
        return $this->token = AccessTokenClient::instance($this->config)->getToken();
    }

    /**
     * 生成签名
     */
    private function getSign()
    {

    }
}