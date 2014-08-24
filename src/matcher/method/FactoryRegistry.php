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
class FactoryRegistry
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
     * @param FactoryInterface $factory
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
     */
    public function get($name)
    {
        $factory = $this->factories->get($name);
        return $factory->get();
    }

}
