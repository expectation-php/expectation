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
class PatternMatcher extends StringMatcher
{
    const FAILURE_MESSAGE = "Expected %s to match %s";
    const NEGATED_FAILURE_MESSAGE = "Expected %s not to match %s";

    const PATTERN = 1;
    const PREFIX = 2;
    const SUFFIX = 3;

    /**
     * @var int
     */
    private $matchType = self::PATTERN;


    /**
     * @Lookup(name="toMatch")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        return (preg_match($this->getMatchPattern(), $this->actualValue) === 1);
    }

    /**
     * @Lookup(name="toStartWith")
     * @param mixed $actual
     * @return boolean
     */
    public function matchPrefix($actual) {
        $this->matchType = self::PREFIX;
        return $this->match($actual);
    }

    /**
     * @Lookup(name="toEndWith")
     * @param mixed $actual
     * @return boolean
     */
    public function matchSuffix($actual) {
        $this->matchType = self::SUFFIX;
        return $this->match($actual);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);

        if ($this->matchType === self::PREFIX) {
            $message = "Expected %s to start with %s";
        } else if ($this->matchType === self::SUFFIX) {
            $message = "Expected %s to end with %s";
        } else {
            $message = "Expected %s to match %s";
        }

        return sprintf($message, $actual, $expected);
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);

        if ($this->matchType === self::PREFIX) {
            $message = "Expected %s not to start with %s";
        } else if ($this->matchType === self::SUFFIX) {
            $message = "Expected %s not to end with %s";
        } else {
            $message = "Expected %s not to match %s";
        }

        return sprintf($message, $actual, $expected);
    }


    private function getMatchPattern()
    {
        if ($this->matchType === self::PATTERN) {
            return $this->expectValue;
        }

        $keyword = preg_quote($this->expectValue, DIRECTORY_SEPARATOR);

        if ($this->matchType === self::PREFIX) {
            return "/^{$keyword}/";
        } else if ($this->matchType === self::SUFFIX) {
            return "/{$keyword}$/";
        }
    }

}
