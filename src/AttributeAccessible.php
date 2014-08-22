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

trait AttributeAccessible
{

    /**
     * @param string $name
     */
    public function __get($name)
    {
        $getterMethod = 'get' . ucfirst($name);

        if (method_exists($this, $getterMethod)) {
            return $this->$getterMethod();
        } else if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new BadPropertyAccessException($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $setterMethod = 'set' . ucfirst($name);

        if (!method_exists($this, $setterMethod)) {
            throw new BadPropertyAccessException($name);
        }
        $method = [$this, $setterMethod];
        $methodArguments = [$value];

        return call_user_func_array($method, $methodArguments);
    }

}
