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
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class TypeMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toBeA")
     * @Lookup(name="toBeAn")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $type = "";
        $this->actualValue = $actual;

        /**
         * is_float(1.1) => true
         * is_double(1.1) => true
         */
        if (in_array($this->expectValue, ['float', 'double'])) {
            $result = is_float($this->actualValue) || is_double($this->actualValue);
        } else {
            if (is_string($this->actualValue)) {
                $type = "string";
            } else if (is_integer($this->actualValue)) {
                $type = "integer";
            } else if (is_bool($this->actualValue)) {
                $type = "boolean";
            } else if (is_array($this->actualValue)) {
                $type = "array";
            }
            $result = ($type === $this->expectValue);
        }

        return $result;
    }

    /**
     * @Lookup(name="toBeString")
     */
    public function matchString($actual)
    {
        return $this->setExpectValue('string')->match($actual);
    }

    /**
     * @Lookup(name="toBeInteger")
     */
    public function matchInteger($actual)
    {
        return $this->setExpectValue('integer')->match($actual);
    }

    /**
     * @Lookup(name="toBeFloat")
     */
    public function matchFloat($actual)
    {
        return $this->setExpectValue('float')->match($actual);
    }

    /**
     * @Lookup(name="toBeDouble")
     */
    public function matchDouble($actual)
    {
        return $this->setExpectValue('double')->match($actual);
    }

    /**
     * @Lookup(name="toBeBoolean")
     */
    public function matchBoolean($actual)
    {
        return $this->setExpectValue('boolean')->match($actual);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $type = gettype($this->actualValue);
        return "Expected {$this->expectValue}, got {$type}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return "Expected a type other than {$this->expectValue}";
    }

}
