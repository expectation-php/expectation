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
use Iterator;


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
            $message  = "'%s' method of matcher is already registered.\n";
            $message .= "Class is %s, the method is registered with the '%s'.";

            $method = $this->get($name)->getMethod();
            $className = $method->getDeclaringClass()->getName();
            $invokeMethodName = $method->getName();

            $resultMessage = sprintf($message, $name, $className, $invokeMethodName);

            throw new AlreadyRegisteredException($resultMessage);
        }

        $this->factories->set($name, $factory);
    }

    /**
     * @param Iterator $iterator
     */
    public function registerAll(Iterator $iterator)
    {
        foreach ($iterator as $name => $factory) {
            $this->register($name, $factory);
        }
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
