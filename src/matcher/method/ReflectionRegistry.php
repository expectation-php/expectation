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
use \ReflectionMethod;
use \Iterator;
use \Countable;


/**
 * Class ReflectionRegistry
 * @package expectation\matcher\method
 */
class ReflectionRegistry implements Countable
{

    /**
     * @var \PhpCollection\Map
     */
    private $reflections;


    public function __construct()
    {
        $this->reflections = new Map();
    }

    /**
     * @param string $name
     * @param ReflectionMethod $reflection
     * @throws AlreadyRegisteredException
     */
    public function register($name, ReflectionMethod $reflection)
    {
        if ($this->contains($name)) {
            $exception = $this->createAlreadyRegisteredException($name);
            throw $exception;
        }

        $this->reflections->set($name, $reflection);
    }

    /**
     * @param Iterator $iterator
     */
    public function registerAll(Iterator $iterator)
    {
        foreach ($iterator as $name => $reflection) {
            $this->register($name, $reflection);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function contains($name)
    {
        return $this->reflections->containsKey($name);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->reflections->count();
    }

    /**
     * @param string $name
     * @throws FactoryNotFoundException
     */
    public function get($name)
    {
        if ($this->contains($name) === false) {
            throw new ReflectionNotFoundException("'{$name}' was not found.");
        }

        $result = $this->reflections->get($name);
        $reflection = $result->get();

        return $reflection;
    }

    /**
     * @param string $name
     * @throws AlreadyRegisteredException
     */
    private function createAlreadyRegisteredException($name)
    {
        $message  = "'%s' method of matcher is already registered.\n";
        $message .= "Class is %s, the method is registered with the '%s'.";

        $method = $this->get($name);
        $className = $method->getDeclaringClass()->getName();
        $invokeMethodName = $method->getName();

        $resultMessage = sprintf($message, $name, $className, $invokeMethodName);

        return new AlreadyRegisteredException($resultMessage);
    }

}
