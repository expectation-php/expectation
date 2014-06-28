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


class EqualMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toEqual")
     * @param mixed $actual
     */
    public function match($actual)
    {
        $this->actual = $actual;
        return $this->expected === $this->actual;
    }

    /**
     * @Lookup(name="toBeTrue")
     */
    public function matchTrue($actual)
    {
        return $this->expected(true)->match($actual);
    }

    /**
     * @Lookup(name="toBeFalse")
     */
    public function matchFalse($actual)
    {
        return $this->expected(false)->match($actual);
    }

    /**
     * @Lookup(name="toBeNull")
     */
    public function matchNull($actual)
    {
        return $this->expected(null)->match($actual);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->formatter->toString($this->actual);
        $expected = $this->formatter->toString($this->expected);
        return "Expected {$actual} to be {$expected}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->formatter->toString($this->actual);
        $expected = $this->formatter->toString($this->expected);
        return "Expected {$actual} not to be {$expected}";
    }

}
