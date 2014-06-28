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

class Method implements MethodInterface
{

    /**
     * @var \ReflectionMethod
     */
    private $method;

    /**
     * @var mixed
     */
    private $expected;

    /**
     * @param ReflectionMethod $method
     */
    public function __construct(ReflectionMethod $method)
    {
        $this->method = $method;
    }

    public function expected($expected)
    {
        $this->expected = $expected;
        return $this;
    }

    public function positiveMatch($actual)
    {
        return $this->call($actual);
    }

    public function negativeMatch($actual)
    {
        return ($this->call($actual) === false);
    }

    private function call($actual)
    {
        $class = $this->method->getDeclaringClass();

        $matcher = $class->newInstance();
        $matcher->expected($this->expected);

        return $this->method->invokeArgs($matcher, [$actual]);
    }

    /**
     * FIXME throw exception!!
     */
    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            return null;
        }
        return $this->$name;
    }

    public function __set($name, $value)
    {
        if (!method_exists($this, $name)) {
            throw new BadMethodCallException('accessor {$name} does not exist');
        }
        return call_user_func_array([$this, $name], [$value]);
    }

}
