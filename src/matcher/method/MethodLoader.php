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
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use FilesystemIterator;
use ReflectionMethod;
use ReflectionClass;
use expectation\matcher\annotation\Lookup;


class MethodLoader
{

    const MATCHER_PATTERN = "/Matcher\\.php$/";

    /**
     * @var array
     */
    private $namespaces;

    /**
     * @var array
     */
    private $factories;

    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    private $annotationReader;

    /**
     * @param \Doctrine\Common\Annotations\Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->namespaces = [];
        $this->factories = [];
        $this->annotationReader = $annotationReader;
    }

    public function registerNamespace($namespace, $directory)
    {
        $this->namespaces[$namespace] = $directory;
        return $this;
    }

    /**
     * @return MatcherContainerInterface
     */
    public function load()
    {
        foreach ($this->namespaces as $namespace => $directory) {
            $iterator = $this->getRecursiveIterator($directory);

            foreach ($iterator as $matcherFile) {
                $name = $matcherFile->getFilename();

                if (preg_match(static::MATCHER_PATTERN, $name) === 0) {
                    continue;
                }

                $className = str_replace(".php", "", $name);
                $this->loadFactoriesFromClassName($namespace . "\\" . $className);
            }
        }

        return new MethodContainer($this->factories);
    }

    private function loadFactoriesFromClassName($className)
    {
        $reflection = new ReflectionClass($className);
        $methods = $reflection->getMethods();

        foreach($methods as $method) {
            $annotations = $this->getAnnotationsFromMethod($method);
            foreach ($annotations as $annotation) {
                $registerName = $annotation->getLookupName();
                $registerFactory = $annotation->getMatcherMethodFactory($method);

                $this->factories[$registerName] = $registerFactory;
            }
        }
    }

    /**
     * @param ReflectionMethod $method
     * @return array
     */
    private function getAnnotationsFromMethod(ReflectionMethod $method)
    {
        $results = [];
        $annotations = $this->annotationReader->getMethodAnnotations($method);

        foreach($annotations as $annotation) {
            if (!($annotation instanceof Lookup)) {
                continue;
            }
            $results[] = $annotation;
        }

        return $results;
    }

    /**
     * @param string $directory
     * @return RecursiveIteratorIterator
     */
    private function getRecursiveIterator($directory)
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directory,
                FilesystemIterator::CURRENT_AS_FILEINFO |
                FilesystemIterator::KEY_AS_PATHNAME |
                FilesystemIterator::SKIP_DOTS
            ),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        return $iterator;
    }

}
