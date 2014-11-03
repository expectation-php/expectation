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
use expectation\matcher\annotation\Lookup;
use PhpCollection\Sequence;
use expectation\matcher\NamespaceReflection;
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
     * @var \expectation\matcher\method\FactoryLoader
     */
    private $factoryLoader;

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
        $this->factoryLoader = new FactoryLoader($annotationReader);
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
     * @return MethodContainer
     */
    public function load()
    {
        $this->autoLoader->register();

        $factories = $this->factoryLoader->loadFromNamespaces($this->namespaces);

        $registry = new FactoryRegistry();
        $registry->registerAll($factories);

        return new MethodContainer($registry);
    }

}
