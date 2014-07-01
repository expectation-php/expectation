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
class LengthMatcher extends AbstractMatcher
{

    /**
     * @var string
     */
    private $type;

    /**
     * @Lookup(name="toHaveLength")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;

        $that = $this->actualValue;
        $expected = $this->expectValue;

        if (is_string($that) === true) {
            $length = mb_strlen($that);
            $this->type = 'string';
        } else if (is_array($that) === true) {
            $length = count($that);
            $this->type = 'array';
        } else if ($that instanceof Countable) {
            $length = count($that);
            $this->type = get_class($that);
        }

        return ($length === $expected);
    }

    /**
     * @Lookup(name="toBeEmpty")
     * @param mixed $actual
     * @return boolean
     */
    public function matchEmpty($actual)
    {
        return $this->setExpectValue(0)->match($actual);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        return "Expected {$this->type} to have a length of {$this->expectValue}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return "Expected {$this->type} not to have a length of {$this->expectValue}";
    }

}
