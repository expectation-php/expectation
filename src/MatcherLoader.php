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

use Doctrine\Common\Annotations\Reader;
use RecursiveIteratorIterator;
use FilesystemIterator;
use ReflectionMethod;
use SplStack;
use expectation\matcher\annotation\Lookup;

class MatcherLoader
{

    const MATCHER_PATTERN = "/Matcher\\.php$/";

    /**
     * @var SplStack
     */
    private $container;

    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    private $annotationReader;

    /**
     * @param \Doctrine\Common\Annotations\Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->container = new SplStack;
        $this->annotationReader = $reader;
    }

    /**
     * @return MatcherContainerInterface
     */
    public function load()
    {
        $iterator = $this->getRecursiveIterator(__DIR__);

        foreach ($iterator as $matcherFile) {
            $name = $matcherFile->getFilename();

            if (preg_match(static::MATCHER_PATTERN, $name) === 0) {
                continue;
            }
            $className = str_replace(".php", "", $name);
            $this->loadFactoriesFromClassName($namespace . $className);
        }

        return new MatcherContainer($this->container);
    }

    private function loadFactoriesFromClassName($className)
    {
        $reflection = new ReflectionClass($className);
        $methods = $reflection->getMethods();

        foreach($methods as $method) {
            $annotations = $this->getAnnotationsFromMethod($method);

            foreach ($annotations as $annotation) {
                $registerName = $annotation->getLookupName();
                $registerFactory = $annotation->getMatcherFactory($method);
                $this->container->add($registerName, $registerFactory);
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
