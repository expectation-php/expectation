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
class RangeMatcher extends AbstractMatcher
{

    const FAILURE_MESSAGE = "Expected %d to be within %d between %d";
    const NEGATED_FAILURE_MESSAGE = "Expected %d not to be within %d between %d";

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
        return $this->formatMessage(static::FAILURE_MESSAGE);
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return $this->formatMessage(static::NEGATED_FAILURE_MESSAGE);
    }

    /**
     * @param string $template
     * @return string
     */
    private function formatMessage($template)
    {
        list($from, $to) = $this->expectValue;
        return sprintf($template, $this->actualValue, $from, $to);
    }

}
