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
use InvalidArgumentException;

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
     * @var array
     */
    private $matchResults = [];

    /**
     * @var array
     */
    private $unmatchResults = [];


    /**
     * @Lookup(name="toContain")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {

        if ($this->validate($actual) === false) {
            throw new InvalidArgumentException();
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
        $included = false;
        $expectValues = (is_array($this->expectValue))
            ? $this->expectValue : [$this->expectValue];

        foreach($expectValues as $expectValue) {
            $result = strpos($this->actualValue, $expectValue);
            if ($result === false) {
                $this->unmatchResults[] = $expectValue;
                continue;
            }
            $this->matchResults[] = $expectValue;
            $included = true;
            break;
        }
        return $included;
    }

    /**
     * @return boolean
     */
    private function matchArray()
    {
        $included = false;
        $expectValues = (is_array($this->expectValue))
            ? $this->expectValue : [$this->expectValue];

        foreach($expectValues as $expectValue) {
            $result = in_array($expectValue, $this->actualValue);
            if ($result === false) {
                $this->unmatchResults[] = $expectValue;
                continue;
            }
            $this->matchResults[] = $expectValue;
            $included = true;
            break;
        }
        return $included;
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $missing = implode(', ', $this->unmatchResults);
        return "Expected {$this->type} to contain {$missing}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $found = implode(', ', $this->matchResults);
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
