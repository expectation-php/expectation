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
class SuffixMatcher extends StringMatcher
{

    const FAILURE_MESSAGE = "Expected %s to end with %s";
    const NEGATED_FAILURE_MESSAGE = "Expected %s not to end with %s";

    /**
     * @Lookup(name="toEndWith")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->actualValue = $actual;
        $suffix = preg_quote($this->expectValue, DIRECTORY_SEPARATOR);
        return (preg_match("/{$suffix}$/", $this->actualValue) === 1);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        return $this->getMessageFromTemplate(self::FAILURE_MESSAGE);
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return $this->getMessageFromTemplate(self::NEGATED_FAILURE_MESSAGE);
    }

}
