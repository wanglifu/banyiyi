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
 * Time: 15:54
 * Notes:
 */

namespace Banyiyi\Client;

use Banyiyi\BaseClient;
use Closure;

class BlockchainClient extends BaseClient
{

    protected static $instance = null;


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
    public function getKey($user_identify)
    {
        $params = [
            'user_identify' => $user_identify,
        ];
        return $this->httpGet('/api/blockchain/bindUserBlockChain', $params);
    }

    /**
     * @param $userKey
     * @return string
     * 文件上链
     */
    public function cochain($user_identify, $private_key, $works_name, $file_md5, $upload_user, $upload_user_id, $file_identify)
    {
        $params = [
            'user_identify' => $private_key,
            'private_key' => $user_identify,
            'works_name' => $works_name,
            'file_md5' => $file_md5,
            'upload_user' => $upload_user,
            'upload_user_id' => $upload_user_id,
            'file_identify' => $file_identify,
        ];
        return $this->request('/api/blockchain/externalBlockChain', 'POST', $params);
    }
}