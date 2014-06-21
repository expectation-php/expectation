<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher;

use ReflectionMethod;

class MatcherFactory implements MatcherFactoryInterface
{

    /**
     * @var ReflectionMethod
     */
    private $method;

    /**
     * @param ReflectionMethod $method
     */
    public function __construct(ReflectionMethod $method)
    {
        $this->method = $method;
    }

    public function withArguments(array $arguments) {
        $classReflection = $this->method->getDeclaringClass();
        $matcher = $classReflection->newInstance();

        if (!empty($arguments)) {
            $matcher->expected($arguments[0]);
        }

        return $matcher;
    }

}
