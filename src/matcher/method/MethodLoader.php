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

use expectation\matcher\NamespaceReflection;
use expectation\matcher\annotation\Lookup;
use expectation\matcher\reflection\ReflectionRegistry;
use expectation\matcher\reflection\ReflectionLoader;
use Doctrine\Common\Annotations\Reader;
use PhpCollection\Sequence;
use Zend\Loader\StandardAutoloader;


/**
 * Class MethodLoader
 * @package expectation\matcher\method
 */
class MethodLoader
{

    /**
     * @var \PhpCollection\Sequence
     */
    private $namespaces;

    /**
     * @var \expectation\matcher\reflection\ReflectionLoader
     */
    private $reflectionLoader;

    /**
     * @var StandardAutoloader
     */
    private $autoLoader;


    /**
     * @param \Doctrine\Common\Annotations\Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->namespaces = new Sequence();
        $this->autoLoader = new StandardAutoloader();
        $this->reflectionLoader = new ReflectionLoader($annotationReader);
    }

    /**
     * @param string $namespace
     * @param string $directory
     * @return $this
     */
    public function registerNamespace($namespace, $directory)
    {
        $this->autoLoader->registerNamespace($namespace, $directory);

        $namespaceReflection = new NamespaceReflection($namespace, $directory);
        $this->namespaces->add($namespaceReflection);

        return $this;
    }

    /**
     * @return MethodResolver
     */
    public function load()
    {
        $this->autoLoader->register();

        $reflections = $this->reflectionLoader->loadFromNamespaces($this->namespaces);

        $registry = new ReflectionRegistry();
        $registry->registerAll($reflections);

        return new MethodResolver($registry);
    }

}
