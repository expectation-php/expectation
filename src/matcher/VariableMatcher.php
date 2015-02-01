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
 * @package expectation\matcher
 * @property mixed $actualValue
 * @property mixed $expectValue
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class VariableMatcher extends AbstractMatcher
{

    /**
     * @var string
     */
    private $matchType;

    /**
     * @var string
     */
    private $negatedMatchType;

    /**
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->setActualValue($actual);
        $actualValue = $this->getActualValue();

        if (is_bool($actualValue)) {
            return $actualValue !== false;
        }

        return isset($actualValue);
    }

    /**
     * @Lookup(name="toBeTruthy")
     * @param mixed $actual
     * @return boolean
     */
    public function matchTruthy($actual)
    {
        $this->matchType = 'truthy';
        $this->negatedMatchType = 'falsey';

        return $this->match($actual);
    }

    /**
     * @Lookup(name="toBeFalsey")
     * @param mixed $actual
     * @return boolean
     */
    public function matchFalsey($actual)
    {
        $this->matchType = 'falsey';
        $this->negatedMatchType = 'truthy';

        return $this->match($actual) === false;
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->getFormatter()->toString($this->getActualValue());
        return "Expected {$this->matchType} value, got {$actual}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->getFormatter()->toString($this->getActualValue());
        return "Expected {$this->negatedMatchType} value, got {$actual}";
    }

}
