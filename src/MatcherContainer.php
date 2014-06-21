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

use ArrayObject;
use ArrayIterator;

class MatcherContainer implements MatcherContainerInterface
{

    /**
     * @var ArrayObject
     */
    private $values;

    public function __construct(ArrayObject $values)
    {
        $this->values = $values;
    }

    /**
     * @return \expectation\matcher\MatcherInterface
     */
    public function find($name, array $arguments)
    {
        $factory = null;
        $iterator = new ArrayIterator($this->values);

        while($iterator->valid()) {
            $lookUpKey = $iterator->key();

            if ($lookUpKey !== $name) {
                continue;
            }
            $factory = $iterator->current();
            break;
        }

        return $factory->withArguments($arguments);
    }

}
