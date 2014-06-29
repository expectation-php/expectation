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
use expectation\ExpectationException;
use Symfony\Component\Config\Definition\Exception\Exception;

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
     * @var \expectation\MatcherInterface
     */
    private $matcher;


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
        if ($this->call($actual)) {
            return true;
        }
        $this->throwFailureException();
    }

    public function negativeMatch($actual)
    {
        if ($this->call($actual) === false) {
            return true;
        }
        $this->throwNagativeFailureException();
    }

    private function call($actual)
    {
        $class = $this->method->getDeclaringClass();

        $this->matcher = $class->newInstanceArgs([ new Formatter() ]);
        $this->matcher->expected($this->expected);

        return $this->method->invokeArgs($this->matcher, [$actual]);
    }

    private function throwFailureException()
    {
        $message = $this->matcher->getFailureMessage();
        throw new ExpectationException($message);
    }

    private function throwNagativeFailureException()
    {
        $message = $this->matcher->getNegatedFailureMessage();
        throw new ExpectationException($message);
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
