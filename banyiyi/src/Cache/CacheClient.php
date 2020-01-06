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
 * Time: 13:46
 * Notes:
 */

namespace Banyiyi\Client;

use http\Exception\InvalidArgumentException;
use Psr\Cache\CacheItemPoolInterface;
use Psr\SimpleCache\CacheInterface as SimpleCacheInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Simple\FilesystemCache;
use Symfony\Component\Cache\Simple\Psr6Cache;

class CacheClient
{
    protected $cache;


    /**
     * @return Psr16Cache|FilesystemCache
     * 获取缓存
     */
    public function getCache()
    {
        if ($this->cache) {
            return $this->cache;
        }

        return $this->cache = $this->createDefaultCache();
    }


    /**
     * @param $cache
     * @return $this
     * 设置缓存
     */
    public function setCache($cache)
    {
        if (empty(\array_intersect([SimpleCacheInterface::class, CacheItemPoolInterface::class], \class_implements($cache)))) {
            throw new InvalidArgumentException(
                \sprintf('The cache instance must implements %s or %s interface.',
                    SimpleCacheInterface::class, CacheItemPoolInterface::class
                )
            );
        }

        if ($cache instanceof CacheItemPoolInterface) {
            if (!$this->isSymfony43()) {
                throw new InvalidArgumentException(sprintf('The cache instance must implements %s', SimpleCacheInterface::class));
            }
            $cache = new Psr6Cache($cache);
        }

        $this->cache = $cache;

        return $this;
    }


    /**
     * @return Psr16Cache|FilesystemCache
     * 默认缓存
     */
    protected function createDefaultCache()
    {
        if ($this->isSymfony43()) {
            return new Psr6Cache(new FilesystemAdapter('banyiyi', 1500));
        }

        return new FilesystemCache();
    }


    protected function isSymfony43(): bool
    {
        return \class_exists('Symfony\Component\Cache\Simple\Psr6Cache');
    }
}