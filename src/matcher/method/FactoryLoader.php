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
use ReflectionMethod;
use ReflectionClass;
use PhpCollection\Map;


/**
 * Class FactoryLoader
 * @package expectation\matcher\method
 */
class FactoryLoader
{

    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    private $annotationReader;


    /**
     * @param \Doctrine\Common\Annotations\Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param ReflectionClass $classReflection
     * @return \ArrayIterator
     */
    public function loadFromClass(ReflectionClass $classReflection)
    {
        return $this->parseAnnotations($classReflection);
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
