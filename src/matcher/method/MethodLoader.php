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

use Doctrine\Common\Annotations\Reader;
use ReflectionClass;
use expectation\matcher\annotation\Lookup;
use PhpCollection\Sequence;
use expectation\matcher\NamespaceReflection;


/**
 * Class MethodLoader
 * @package expectation\matcher\method
 */
class MethodLoader
{

    /**
     * @var \PhpCollection\Sequence
     */
    private $classes;

    /**
     * @var \PhpCollection\Sequence
     */
    private $namespaces;

    /**
     * @var FactoryRegistry
     */
    private $registry;

    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    private $annotationReader;

    /**
     * @var \expectation\matcher\method\FactoryLoader
     */
    private $factoryLoader;


    /**
     * @param \Doctrine\Common\Annotations\Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->classes = new Sequence();
        $this->namespaces = new Sequence();
        $this->registry = new FactoryRegistry();
        $this->annotationReader = $annotationReader;
        $this->factoryLoader = new FactoryLoader($annotationReader);
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return $this
     */
    public function registerClass(ReflectionClass $reflectionClass)
    {
        $this->classes->add($reflectionClass);
        return $this;
    }

    /**
     * @param string $namespace
     * @param string $directory
     * @return $this
     */
    public function registerNamespace($namespace, $directory)
    {
        $namespaceReflection = new NamespaceReflection($namespace, $directory);
        $this->namespaces->add($namespaceReflection);

        return $this;
    }

    /**
     * @return MethodContainer
     */
    public function load()
    {
        $this->loadFactoriesFromClasses();
        $this->loadFactoriesFromNamespace();

        return new MethodContainer($this->registry);
    }

    /**
     * @throws AlreadyRegisteredException
     */
    private function loadFactoriesFromNamespace()
    {
        $namespaceReflections = $this->namespaces->getIterator();

        foreach($namespaceReflections as $namespaceReflection) {
            $classReflections = $namespaceReflection->getClassReflections();

            foreach ($classReflections as $classReflection) {
                $this->loadFactoriesFromClass($classReflection);
            }
        }
    }

    /**
     * @throws AlreadyRegisteredException
     */
    private function loadFactoriesFromClasses()
    {
        $reflectionClasses = $this->classes->getIterator();

        foreach ($reflectionClasses as $reflectionClass) {
            $this->loadFactoriesFromClass($reflectionClass);
        }
    }

    /**
     * @param ReflectionClass $reflectionClass
     */
    private function loadFactoriesFromClass(ReflectionClass $reflectionClass)
    {
        $factories = $this->factoryLoader->loadFromClass($reflectionClass);
        $this->registry->registerAll($factories);
    }

}
