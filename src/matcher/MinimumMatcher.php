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
class MinimumMatcher extends AbstractMatcher
{

    const FAILURE_MESSAGE = "Expected %s to be greater than %s";
    const NEGATED_FAILURE_MESSAGE = "Expected %s not to be greater than %s";

    /**
     * @Lookup(name="toBeGreaterThan")
     * @Lookup(name="toBeAbove")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->setActualValue($actual);
        return $this->getActualValue() > $this->getExpectValue();
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        return $this->getMessageFromTemplate(self::FAILURE_MESSAGE);
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return $this->getMessageFromTemplate(self::NEGATED_FAILURE_MESSAGE);
    }

    /**
     * @return string
     */
    private function getMessageFromTemplate($template)
    {
        $actual = $this->formatter->toString($this->getActualValue());
        $expected = $this->formatter->toString($this->getExpectValue());

        return sprintf($template, $actual, $expected);
    }

}
