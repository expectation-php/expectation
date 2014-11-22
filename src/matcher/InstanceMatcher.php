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
class InstanceMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toBeAnInstanceOf")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->setActualValue($actual);

        $actualValue = $this->getActualValue();
        $expectValue = $this->getExpectValue();

        return $actualValue instanceof $expectValue;
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $className = get_class($this->getActualValue());
        return "Expected an instance of {$this->getExpectValue()}, got {$className}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return "Expected an instance other than {$this->getExpectValue()}";
    }

}
