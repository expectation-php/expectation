<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher\method;

class MethodContainer implements MethodContainerInterface
{

    /**
     * @var ArrayObject
     */
    private $factories;

    /**
     * @param array $factories
     */
    public function __construct(array $factories)
    {
        $this->factories = $factories;
    }

    /**
     * @return \expectation\matcher\MethodInterface
     */
    public function find($name, array $arguments)
    {
        if (!isset($this->factories[$name])) {
            throw new FactoryNotFoundException('{$name} is not found');
        }
        $factory = $this->factories[$name];

        return $factory->withArguments($arguments);
    }

}
