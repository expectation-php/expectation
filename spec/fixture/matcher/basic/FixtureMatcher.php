<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\spec\fixture\matcher\basic;

use expectation\AbstractMatcher;
use expectation\matcher\annotation\Lookup;

class FixtureMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toEqual")
     * @param mixed $actual
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        return $this->actualValue === $this->expectValue;
    }

    /**
     * @Lookup(name="equals")
     * @param mixed $actual
     */
    public function equals($actual)
    {
        return $this->match($actual);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);
        return "Expected {$actual} to be {$expected}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);
        return "Expected {$actual} not to be {$expected}";
    }

}
