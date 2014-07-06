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
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class RangeMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toBeWithin")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
    }

}
