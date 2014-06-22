<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation;

use ReflectionMethod;
use expectation\matcher\MethodWrapper;

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

    /**
     * @param array $arguments
     * @return \expectation\matcher\MethodWrapperInterface
     */
    public function withArguments(array $arguments) {
        $wrapper = new MethodWrapper($this->method);

        if (!empty($arguments)) {
            $wrapper->expected($arguments[0]);
        }

        return $wrapper;
    }

}
