<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher\method;

use ReflectionMethod;
use expectation\matcher\Method;

class MethodFactory implements MethodFactoryInterface
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
     * @return ReflectionMethod
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param array $arguments
     * @return \expectation\matcher\Method
     */
    public function createWithArguments(array $arguments) {
        $wrapper = new Method($this->method);

        if (!empty($arguments)) {
            $expectValue = $this->expectValueFrom($arguments);
            $wrapper->setExpectValue($expectValue);
        }

        return $wrapper;
    }

    /**
     * @param array $arguments
     * @return array|mixed
     */
    private function expectValueFrom(array $arguments)
    {
        if (count($arguments) === 1) {
            return $arguments[0];
        } else {
            return $arguments;
        }
    }

}
