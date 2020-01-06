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

require_once 'banyiyi/src/BaseClient.php';

use Banyiyi\Base\BaseClient;
use Closure;

class BlockchainClient extends BaseClient
{

    protected static $instance = null;

    protected $config = [];

    private function __construct($options = [])
    {
        $this->config = $options;
    }


    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }

        return self::$instance;
    }

    /**
     * @param $userKey
     * @return string
     * 绑定用户
     */
    public function getKey($userKey)
    {
        $params = [
            'userKey' => $userKey,
        ];
        return $this->httpGet('http://open.banyiyi.com/api/blockchain/bindUserBlockChain', $params);
    }

    /**
     * @param $userKey
     * @return string
     * 文件上链
     */
    public function cochain($userKey)
    {
        $params = [
            'userKey' => $userKey,
        ];
        return $this->httpPost('http://open.banyiyi.com/api/blockchain/bindUserBlockChain', $params);
    }
}