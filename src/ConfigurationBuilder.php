<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation;

use expectation\matcher\method\MethodLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use PhpCollection\Map;
use ReflectionClass;
use ReflectionException;

/**
 * @package expectation
 */
class ConfigurationBuilder
{

    /**
     * @var \PhpCollection\Map
     */
    private $matcherNamespaces;

    /**
     * @var \PhpCollection\Map
     */
    private $matcherClasses;

    public function __construct()
    {
        $this->matcherClasses = new Map();
        $this->matcherNamespaces = new Map();
        $this->registerMatcherNamespace('\\expectation\\matcher', __DIR__ . '/matcher');
    }

    /**
     * @param string $namespace
     * @param string $directory
     * @return $this
     */
    public function registerMatcherNamespace($namespace, $directory)
    {
        $this->matcherNamespaces->set($namespace, $directory);
        return $this;
    }

    /**
     * @return Map
     */
    public function getMatcherNamespaces()
    {
        return $this->matcherNamespaces;
    }

    /**
     * @param string $className
     * @return $this
     */
    public function registerMatcherClass($className)
    {
        try {
            $reflectionClass = new ReflectionClass($className);
        } catch (ReflectionException $exception) {
            throw new MatcherNotFoundException($exception->getMessage());
        }

        $this->matcherClasses->set($className, $reflectionClass);
        return $this;
    }

    /**
     * @return Map
     */
    public function getMatcherClasses()
    {
        return $this->matcherClasses;
    }

    /**
     * @return \expectation\Configuration
     */
    public function build()
    {
        $loader = new MethodLoader(new AnnotationReader());

        foreach ($this->matcherNamespaces as $namespace => $directory) {
            $loader->registerNamespace($namespace, $directory);
        }

        foreach ($this->matcherClasses as $reflectionClass) {
            $loader->registerClass($reflectionClass);
        }

        $config = new Configuration([
            'methodContainer' => $loader->load()
        ]);

        return $config;
    }

}
