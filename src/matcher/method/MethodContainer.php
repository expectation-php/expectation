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

use PhpCollection\MapInterface;

class MethodContainer implements MethodContainerInterface
{

    /**
     * @var MapInterface
     */
    private $factories;

    /**
     * @param MapInterface $factories
     */
    public function __construct(MapInterface $factories)
    {
        $this->factories = $factories;
    }

    /**
     * @return \expectation\matcher\MethodInterface
     */
    public function find($name, array $arguments)
    {
        if ($this->factories->containsKey($name) === false) {
            throw new FactoryNotFoundException("{$name} is not found");
        }
        $factory = $this->factories->get($name);

        return $factory->get()->withArguments($arguments);
    }

}
