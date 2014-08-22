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
 * @property mixed $actualValue
 * @property mixed $expectValue
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class MaximumMatcher extends AbstractMatcher
{

    const FAILURE_MESSAGE = "Expected %s to be less than %s";
    const NEGATED_FAILURE_MESSAGE = "Expected %s not to be less than %s";

    /**
     * @Lookup(name="toBeLessThan")
     * @Lookup(name="toBeBelow")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        return $this->actualValue < $this->expectValue;
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);
        return sprintf(self::FAILURE_MESSAGE, $actual, $expected);
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);
        return sprintf(self::NEGATED_FAILURE_MESSAGE, $actual, $expected);
    }

}
