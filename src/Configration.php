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

/**
 * @package expectation
 */
class Configration
{

    /**
     * @var MatcherMethodContainerInterface
     */
    private $methodContainer;

    public function __construct(array $values)
    {
        foreach($values as $name => $value) {
            $this->$name = $value;
        }
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
