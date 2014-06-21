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

use BadMethodCallException;

abstract class AbstractMatcher implements MatcherInterface
{

    /**
     * @var mixed
     */
    private $expected;

    /**
     * @param mixed $expected
     */
    public function expected($expected)
    {
        $this->expected = $expected;
        return $this;
    }

    /**
     * FIXME throw exception!!
     */
    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            return null;
        }
        return $this->$name;
    }

    public function __set($name, $value)
    {
        if (!method_exists($this, $name)) {
            throw new BadMethodCallException('accessor {$name} does not exist');
        }
        return call_user_func_array([$this, $name], [$value]);
    }

}
