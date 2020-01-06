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
 * Time: 15:31
 * Notes:
 */

namespace Banyiyi\Base;


class Qequest
{
    private $prefix = 'http://open.banyiyi.com';
    /**
     * @param string $url
     * @param array $query
     * @return string
     * get提交
     */
    protected function httpGet(string $url, array $query = [])
    {
        return $this->request($this->prefix.$url, 'GET', ['query' => $query]);
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
        return $this->request($this->prefix.$url, 'POST', ['form_params' => $data, 'verify' => $verify]);
    }

}