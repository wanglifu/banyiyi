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
 * Date: 2020/1/5
 * Time: 15:54
 * Notes:
 */

namespace Banyiyi\Client;

include_once 'banyiyi/src/Cache/CacheClient.php';

use Banyiyi\Cache\CacheClient;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\AggregateException;
use http\Exception\RuntimeException;

class AccessTokenClient extends CacheClient
{

    protected static $instance = null;


    protected $config = [];

    /**
     * @var string
     */
    protected $cachePrefix = 'banyiyi.access_token.';

    protected function __construct($options = [])
    {
        $this->config = $options;
    }

    /**
     * @param array $options
     * @return static|null
     * 实例化对象
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }

        return self::$instance;
    }

    /**
     * @return string
     * 获取token
     */
    public function getToken(bool $refresh = false)
    {
        $cacheKey = $this->getCacheKey();
        $cache = $this->getCache();

        if (!$refresh && $cache->has($cacheKey)) {
            return $cache->get($cacheKey);
        }

        return $this->httpPost('http://open.banyiyi.com/api/common/getAppToken', $this->config);

    }


    public function setToken(string $token, int $lifetime = 7200)
    {
        $this->getCache()->set($this->getCacheKey(), [
            $this->tokenKey => $token,
            'expires_in' => $lifetime,
        ], $lifetime - $this->safeSeconds);

        if (!$this->getCache()->has($this->getCacheKey())) {
            throw new RuntimeException('Failed to cache access token.');
        }

        return $this;
    }

    /**
     * 重新获取
     */
    public function refreshToekn()
    {
        $this->getToken(true);
        return $this;
    }

    /**
     * @param string $url
     * @param array $query
     * @return string
     * get提交
     */
    protected function httpGet(string $url, array $query = [])
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    /**
     * @param string $url
     * @param array $data
     * @param bool $verify
     * @return string
     * post提交
     */
    protected function httpPost(string $url, array $data = [], $verify = false)
    {
        return $this->request($url, 'POST', ['form_params' => $data, 'verify' => $verify]);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @param bool $returnRaw
     * @return string
     * 请求
     */
    protected function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        try {
            $client = new Client();
            $response = $client->request($method, $url, $options);
            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        } catch (AggregateException $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return string
     */
    protected function getCacheKey()
    {
        return $this->cachePrefix . md5(json_encode($this->config));
    }
}