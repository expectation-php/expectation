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

use expectation\matcher\method\MethodResolverInterface;

/**
 * @package expectation
 * @method boolean toEqual() toEqual(mixed $expected)
 * @method boolean toBe() toBe(mixed $expected)
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
 * @method boolean toMatch() toMatch(string $expected)
 * @method boolean toStartWith() toStartWith(string $expected)
 * @method boolean toEndWith() toEndWith(string $expected)
 * @method boolean toContain() toContain(string $expected)
 * @method boolean toHaveKey() toHaveKey(string $expected)
 * @method boolean toBeGreaterThan() toBeGreaterThan(integer $expected)
 * @method boolean toBeLessThan() toBeLessThan(integer $expected)
 * @method boolean toBeAbove() toBeAbove(integer $expected)
 * @method boolean toBeBelow() toBeBelow(integer $expected)
 * @method boolean toBeWithin() toBeWithin(integer $from, integer $to)
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
     * @var \expectation\matcher\method\MethodResolverInterface
     */
    private $resolver;


    /**
     * @param MethodResolverInterface $resolver
     */
    public function __construct(MethodResolverInterface $resolver) {
        $this->resolver = $resolver;
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

        $matcher = $this->resolver->find($name, $arguments);

        if ($this->negated) {
            return $matcher->negativeMatch($this->actual);
        } else {
            return $matcher->positiveMatch($this->actual);
        }
    }

}
