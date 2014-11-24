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

use expectation\AbstractMatcher;
use expectation\matcher\annotation\Lookup;

/**
 * @property mixed $actualValue
 * @property mixed $expectValue
 */
class EqualMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toEqual")
     * @Lookup(name="toBe")
     * @param mixed $actual
     */
    public function match($actual)
    {
        $this->setActualValue($actual);
        return $this->getExpectValue() === $this->getActualValue();
    }

    /**
     * @Lookup(name="toBeTrue")
     */
    public function matchTrue($actual)
    {
        return $this->setExpectValue(true)->match($actual);
    }

    /**
     * @Lookup(name="toBeFalse")
     */
    public function matchFalse($actual)
    {
        return $this->setExpectValue(false)->match($actual);
    }

    /**
     * @Lookup(name="toBeNull")
     */
    public function matchNull($actual)
    {
        return $this->setExpectValue(null)->match($actual);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->getFormatter()->toString($this->getActualValue());
        $expected = $this->getFormatter()->toString($this->getExpectValue());
        return "Expected {$actual} to be {$expected}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->getFormatter()->toString($this->getActualValue());
        $expected = $this->getFormatter()->toString($this->getExpectValue());
        return "Expected {$actual} not to be {$expected}";
    }

}
