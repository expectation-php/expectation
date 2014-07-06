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

use Countable;
use expectation\AbstractMatcher;
use expectation\matcher\annotation\Lookup;

/**
 * @package expectation
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class SuffixMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toEndWith")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        $suffix = preg_quote($this->expectValue, DIRECTORY_SEPARATOR);
        return (preg_match("/{$suffix}$/", $this->actualValue) === 1);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);
        return "Expected {$actual} to end with {$expected}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);
        return "Expected {$actual} not to end with {$expected}";
    }

}
