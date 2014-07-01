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

use expectation\matcher\method\MethodContainerInterface;

/**
 * @package expectation
 * @method boolean toEqual() toEqual(mixed $expected)
 * @method boolean toBeTrue() toBeTrue()
 * @method boolean toBeFalse() toBeFalse()
 * @method boolean toBeNull() toBeNull()
 * @method boolean toBeA() toBeA(string $expected)
 * @method boolean toBeAn() toBeAn(string $expected)
 * @method boolean toBeString() toBeString()
 * @method boolean toBeInteger() toBeInteger()
 * @method boolean toBeFloat() toBeFloat()
 * @method boolean toBeDouble() toBeDouble()
 * @method boolean toBeBoolean() toBeBoolean()
 * @method boolean toBeAnInstanceOf() toBeAnInstanceOf(string $expected)
 * @method boolean toThrow() toThrow(string $expected)
 * @method boolean toHaveLength() toHaveLength(integer $expected)
 * @method boolean toBeEmpty() toBeEmpty()
 * @method boolean toPrint() toPrint(string $expected)
 */
class Evaluator implements EvaluatorInterface
{

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var boolean
     */
    private $negated = false;

    /**
     * @var \expectation\matcher\method\MethodContainerInterface
     */
    private $container;

    /**
     * @param MethodContainerInterface $container
     */
    public function __construct(MethodContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @param mixed $actual
     * @return $this
     */
    public function that($actual)
    {
        $this->actual = $actual;
        return $this;
    }

    /**
     * @return $this
     */
    public function not()
    {
        $this->negated = true;
        return $this;
    }

    public function __call($name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }

        $matcher = $this->container->find($name, $arguments);

        if ($this->negated) {
            return $matcher->negativeMatch($this->actual);
        } else {
            return $matcher->positiveMatch($this->actual);
        }
    }

}
