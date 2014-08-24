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

use PhpCollection\Map;

/**
 * Class FactoryRegistry
 * @package expectation\matcher\method
 */
class FactoryRegistry implements FactoryRegistryInterface
{

    /**
     * @var \PhpCollection\Map
     */
    private $factories;


    public function __construct()
    {
        $this->factories = new Map();
    }


    /**
     * @param string $name
     * @param MethodFactoryInterface $factory
     * @throws \expectation\matcher\method\AlreadyRegisteredException
     */
    public function register($name, MethodFactoryInterface $factory)
    {
        if ($this->contains($name)) {
            $factory = $this->get($name);
            throw new AlreadyRegisteredException($name, $factory->getMethod());
        }

        $this->factories->set($name, $factory);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function contains($name)
    {
        return $this->factories->containsKey($name);
    }

    /**
     * @param string $name
     * @return MethodFactoryInterface
     * @throws \expectation\matcher\method\FactoryNotFoundException
     */
    public function get($name)
    {
        if ($this->contains($name) === false) {
            throw new FactoryNotFoundException("{$name} is not found");
        }

        $result = $this->factories->get($name);
        $factory = $result->get();

        return $factory;
    }

}
