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
 * Time: 11:50
 * Notes:
 */

namespace Banyiyi\Base;


use Banyiyi\Client\AccessTokenClient;
use Closure;

class BaseClient
{

    public $response;
    /**
     * @var array
     */
    private $middlewares = [];

    public function __construct(AccessTokenClient $accessToken)
    {
        $this->accessToken = $accessToken ?? $this->app['access_token'];
    }

    public function httpGet()
    {
        return $this->request($url, 'GET', ['query' => $query]);
    }

    public function request(string $url, string $method = 'GET', array $options = [], $returnRaw = false)
    {
        if (empty($this->middlewares)) {
            $this->registerHttpMiddlewares();
        }

        $response = $this->performRequest($url, $method, $options);

        return $returnRaw ? $response : $this->castResponseToType($response, $this->app->config->get('response_type'));
    }


    /**
     * 执行中间件函数
     * @param mix $request 请求数据
     * @param mix $response 响应数据
     * @param Closure $next 把处理完的结果返回给下一个中间件
     * @return Closure
     */

    private function handle($request, $response, Closure $next)
    {
        return $next($request, $response);
    }

    /**
     * 绑定中间件
     */
    public function bind(Closure $middleware)
    {
        $this->middlewares[] = $middleware;
        return true;
    }

    /**
     * 执行函数
     * @param mix $request 请求数据
     * @param mix $response 响应数据
     * @return mix
     */
    public function run($request, $response = '')
    {
        $this->response = $response;
        foreach ($this->middlewares as $key => $value) {
            $this->response = $this->handle($request, $this->response, $value);
        }
        return $this->response;
    }

    public function middleware()
    {
        $this->bind(function (){
            AccessTokenClient::getToken($this->config);
        });
    }
}

/*$demo = new Demo();
$demo->bind(
    function($requset,$response){
        $response = $response.$requset.' filter By middleware！';
        return $response;
    });
var_dump( $demo->run('someQueryParams') );*/