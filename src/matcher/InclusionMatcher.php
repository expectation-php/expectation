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
use expectation\matcher\strategy\ArrayInclusionStrategy;
use expectation\matcher\strategy\StringInclusionStrategy;
use InvalidArgumentException;
use PhpCollection\Sequence;


/**
 * @package expectation\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class InclusionMatcher extends AbstractMatcher
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var \expectation\matcher\strategy\InclusionResult
     */
    private $matchResult;


    /**
     * @Lookup(name="toContain")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {

        if ($this->validate($actual) === false) {
            throw new InvalidArgumentException('Argument must be an array or string');
        }

        $this->actualValue = $actual;

        if (is_string($this->actualValue)) {
            $this->type = 'string';
            return $this->matchString();
        } else if (is_array($this->actualValue)) {
            $this->type = 'array';
            return $this->matchArray();
        }

        return false;
    }

    /**
     * @return boolean
     */
    private function matchString()
    {
        $expectValues = (is_array($this->expectValue))
            ? $this->expectValue : [$this->expectValue];

        $actualValue = $this->actualValue;

        $strategy = new StringInclusionStrategy($actualValue);
        $this->matchResult = $strategy->match($expectValues);

        return $this->matchResult->isMatched();
    }

    /**
     * @return boolean
     */
    private function matchArray()
    {
        $expectValues = (is_array($this->expectValue))
            ? $this->expectValue : [$this->expectValue];

        $actualValues = $this->actualValue;

        $strategy = new ArrayInclusionStrategy($actualValues);
        $this->matchResult = $strategy->match($expectValues);

        return $this->matchResult->isMatched();
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $unmatchResults = $this->matchResult->getUnmatchResults();
        $missing = implode(', ', $unmatchResults);
        return "Expected {$this->type} to contain {$missing}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $matchResults = $this->matchResult->getMatchResults();
        $found = implode(', ', $matchResults);
        return "Expected {$this->type} not to contain {$found}";
    }

    /**
     * @param $actual
     * @return boolean
     */
    private function validate($actual)
    {
        return (is_array($actual) || is_string($actual));
    }

}
