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
class TruthyMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toBeTruthy")
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
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->getFormatter()->toString($this->getActualValue());
        return "Expected truthy value, got {$actual}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->getFormatter()->toString($this->getActualValue());
        return "Expected falsey value, got {$actual}";
    }

}
