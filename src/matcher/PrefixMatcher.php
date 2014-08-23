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
class PrefixMatcher extends StringMatcher
{

    const FAILURE_MESSAGE = "Expected %s to start with %s";
    const NEGATED_FAILURE_MESSAGE = "Expected %s not to start with %s";

    /**
     * @Lookup(name="toStartWith")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        $prefix = preg_quote($this->expectValue, DIRECTORY_SEPARATOR);
        return (preg_match("/^{$prefix}/", $this->actualValue) === 1);
    }

}
