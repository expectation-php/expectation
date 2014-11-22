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
class PatternMatcher extends AbstractMatcher
{

    const PATTERN = 1;
    const PREFIX = 2;
    const SUFFIX = 3;

    /**
     * @var int
     */
    private $matchType = self::PATTERN;

    /**
     * @var array
     */
    private $resultMessages = [
        self::PATTERN => 'match %s',
        self::PREFIX => 'start with %s',
        self::SUFFIX => 'end with %s'
    ];

    /**
     * @Lookup(name="toMatch")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->setActualValue($actual);
        return (preg_match($this->getMatchPattern(), $this->getActualValue()) === 1);
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
        return $this->createResultMessage("Expected %s to ");
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return $this->createResultMessage("Expected %s not to ");
    }

    /**
     * @return string
     */
    private function getMatchPattern()
    {
        if ($this->matchType === self::PATTERN) {
            return $this->getExpectValue();
        }

        $keyword = preg_quote($this->getExpectValue(), "/");

        if ($this->matchType === self::PREFIX) {
            return "/^{$keyword}/";
        } else if ($this->matchType === self::SUFFIX) {
            return "/{$keyword}$/";
        }
    }

    /**
     * @param string $prefixMessage
     * @return string
     */
    private function createResultMessage($prefixMessage)
    {
        $actual = $this->formatter->toString($this->getActualValue());
        $expected = $this->formatter->toString($this->getExpectValue());

        $message  = $prefixMessage . $this->resultMessages[$this->matchType];

        return sprintf($message, $actual, $expected);
    }

}
