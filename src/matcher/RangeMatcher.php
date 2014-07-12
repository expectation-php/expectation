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
 * @package expectation
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class RangeMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toBeWithin")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        list($from, $to) = $this->expectValue;
        return ($this->actualValue >= $from && $this->actualValue <= $to);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        list($from, $to) = $this->expectValue;

        $actual = $this->formatter->toString($this->actualValue);
        $fromValue = $this->formatter->toString($from);
        $toValue = $this->formatter->toString($to);

        return "Expected {$actual} to be within {$fromValue} between {$toValue}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        list($from, $to) = $this->expectValue;

        $actual = $this->formatter->toString($this->actualValue);
        $fromValue = $this->formatter->toString($from);
        $toValue = $this->formatter->toString($to);

        return "Expected {$actual} not to be within {$fromValue} between {$toValue}";
    }

}
