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
        $this->setActualValue($actual);

        $actualValue = $this->getActualValue();
        $expectValue = $this->getExpectValue();

        $detectType = $this->detectType($actualValue);

        $result = ($detectType === $expectValue);

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
     * @Lookup(name="toBeBoolean")
     */
    public function matchBoolean($actual)
    {
        return $this->setExpectValue('boolean')->match($actual);
    }

    /**
     * @param mixed $value
     * @return string
     */
    private function detectType($value)
    {
        $detectType = gettype($value);
        $detectType = ($detectType === 'double') ? 'float' : $detectType;

        return $detectType;
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actualValue = $this->getActualValue();
        $detectType = $this->detectType($actualValue);

        return "Expected {$this->getExpectValue()}, got {$detectType}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return "Expected a type other than {$this->getExpectValue()}";
    }

}
