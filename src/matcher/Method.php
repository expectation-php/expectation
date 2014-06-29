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
use expectation\AttributeAccessible;
use Symfony\Component\Config\Definition\Exception\Exception;

class Method implements MethodInterface
{

    use AttributeAccessible;

    /**
     * @var \ReflectionMethod
     */
    private $method;

    /**
     * @var mixed
     */
    private $expectValue;

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

    /**
     * @param $expected
     * @return $this
     */
    public function setExpectValue($expected)
    {
        $this->expectValue = $expected;
        return $this;
    }

    /**
     * @param $actual
     * @return boolean
     * @throw \expectation\ExpectationException
     */
    public function positiveMatch($actual)
    {
        if ($this->call($actual)) {
            return true;
        }
        $this->throwFailureException();
    }

    /**
     * @param $actual
     * @return boolean
     * @throw \expectation\ExpectationException
     */
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
        $this->matcher->expected($this->expectValue);

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

}
