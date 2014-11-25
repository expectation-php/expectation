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

use expectation\Populatable;

/**
 * Class FixturePopulatableObject
 * @package expectation\spec\fixture
 */
class FixturePopulatableObject
{

    use Populatable;

    private $name;

    /**
     * @param array $values
     * @throws \expectation\BadPropertyAccessException
     */
    public function __construct(array $values)
    {
        $this->populate($values);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
