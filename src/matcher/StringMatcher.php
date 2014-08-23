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
abstract class StringMatcher extends AbstractMatcher
{

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        return $this->getMessageFromTemplate(static::FAILURE_MESSAGE);
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return $this->getMessageFromTemplate(static::NEGATED_FAILURE_MESSAGE);
    }

    /**
     * @return string
     */
    protected function getMessageFromTemplate($template)
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);

        return sprintf($template, $actual, $expected);
    }

}
