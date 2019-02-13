<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://hyperf.org
 * @document https://wiki.hyperf.org
 * @contact  group@hyperf.org
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace Hyperf\Utils\Traits;

trait CoroutineProxy
{
    public function __call($name, $arguments)
    {
        $target = $this->getTargetObject();
        return $target->{$name}(...$arguments);
    }

    public function __get($name)
    {
        $target = $this->getTargetObject();
        return $target->{$name};
    }

    public function __set($name, $value)
    {
        $target = $this->getTargetObject();
        return $target->{$name} = $value;
    }

    protected function getTargetObject()
    {
        if (! isset($this->proxyKey)) {
            throw new \RuntimeException('$proxyKey property of class missing.');
        }
        return Context::get($this->proxyKey);
    }
}
