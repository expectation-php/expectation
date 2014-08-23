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
class ArrayKeyMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toHaveKey")
     * @param mixed $actual
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        return array_key_exists($this->expectValue, $this->actualValue);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $expectValue = $this->formatter->toString($this->expectValue);
        return "Expected array to have the key {$expectValue}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $expectValue = $this->formatter->toString($this->expectValue);
        return "Expected array not to have the key {$expectValue}";
    }

}
