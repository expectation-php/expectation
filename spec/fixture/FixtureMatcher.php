<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\spec\fixture;

use expectation\AbstractMatcher;

class FixtureMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toEqual")
     * @param mixed $actual
     */
    public function match($actual)
    {
    }

}
