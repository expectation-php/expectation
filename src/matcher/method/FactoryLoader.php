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

use expectation\matcher\annotation\Lookup;
use Doctrine\Common\Annotations\Reader;
use Iterator;
use ReflectionMethod;
use ReflectionClass;
use PhpCollection\Map;


/**
 * Class FactoryLoader
 * @package expectation\matcher\method
 */
class FactoryLoader implements Iterator
{

    /**
     * @var \ArrayIterator
     */
    private $factoryIterator;

    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    private $annotationReader;


    /**
     * @param ReflectionClass $classReflection
     * @param \Doctrine\Common\Annotations\Reader $annotationReader
     */
    public function __construct(ReflectionClass $classReflection, Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
        $this->factoryIterator = $this->parseAnnotations($classReflection);
    }

    public function key()
    {
        return $this->factoryIterator->key();
    }

    public function current()
    {
        return $this->factoryIterator->current();
    }

    public function next()
    {
        return $this->factoryIterator->next();
    }

    public function rewind()
    {
        return $this->factoryIterator->rewind();
    }

    public function valid()
    {
        return $this->factoryIterator->valid();
    }

    /**
     * @param ReflectionClass $classReflection
     * @return \ArrayIterator
     */
    private function parseAnnotations(ReflectionClass $classReflection)
    {
        $registry = new Map();
        $methods = $classReflection->getMethods();

        foreach($methods as $method) {
            $result = $this->parseMethodAnnotations($method);
            $registry->addMap($result);
        }

        return $registry->getIterator();
    }

    /**
     * @param ReflectionMethod $method
     * @return Map
     */
    private function parseMethodAnnotations(ReflectionMethod $method)
    {
        $registry = new Map();
        $annotations = $this->annotationReader->getMethodAnnotations($method);

        foreach ($annotations as $annotation) {
            if (!($annotation instanceof Lookup)) {
                continue;
            }

            $registerName = $annotation->getLookupName();
            $registerFactory = $annotation->getMethodFactory($method);

            $registry->set($registerName, $registerFactory);
        }

        return $registry;
    }

}
