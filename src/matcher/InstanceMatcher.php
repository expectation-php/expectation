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
class InstanceMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toBeAnInstanceOf")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        return $this->actualValue instanceof $this->expectValue;
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $className = get_class($this->actualValue);
        return "Expected an instance of {$this->expectValue}, got {$className}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return "Expected an instance other than {$this->expectValue}";
    }

}
