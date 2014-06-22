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
use expectation\matcher\MatcherMethod;

class MatcherMethodFactory implements MatcherMethodFactoryInterface
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
     * @return \expectation\matcher\MatcherMethod
     */
    public function withArguments(array $arguments) {
        $wrapper = new MatcherMethod($this->method);

        if (!empty($arguments)) {
            $wrapper->expected($arguments[0]);
        }

        return $wrapper;
    }

}
