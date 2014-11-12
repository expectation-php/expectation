<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation;

/**
 * Trait Populatable
 * @package expectation
 */
trait Populatable
{

    /**
     * @param array $values
     * @throws BadPropertyAccessException
     */
    public function populate(array $values)
    {
        foreach($values as $name => $value) {
            if (property_exists($this, $name) === false) {
                throw new BadPropertyAccessException($name);
            }
            $this->$name = $value;
        }
    }

}
