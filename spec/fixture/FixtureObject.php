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

use expectation\AttributeAccessible;

class FixtureObject
{

    use AttributeAccessible;

    private $name;

    protected function setName($name)
    {
        $this->name = $name;
    }

}
