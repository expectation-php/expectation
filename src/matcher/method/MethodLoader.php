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
use PhpCollection\Map;
use PhpCollection\Sequence;

class MethodLoader
{

    const MATCHER_PATTERN = "/Matcher\\.php$/";

    /**
     * @var \PhpCollection\Sequence
     */
    private $classes;

    /**
     * @var \PhpCollection\Map
     */
    private $namespaces;

    /**
     * @var \PhpCollection\Map
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
        $this->classes = new Sequence();
        $this->namespaces = new Map();
        $this->factories = new Map();
        $this->annotationReader = $annotationReader;
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
        $this->namespaces->set($namespace, $directory);
        return $this;
    }

    /**
     * @return MethodContainer
     */
    public function load()
    {
        $this->loadFactoriesFromClasses();
        $this->loadFactoriesFromNamespace();

        return new MethodContainer($this->factories);
    }

    /**
     * @throws AlreadyRegisteredException
     */
    private function loadFactoriesFromNamespace()
    {
        $namespaces = $this->namespaces->getIterator();

        foreach($namespaces as $namespace => $directory) {
            $fileIterator = $this->getRecursiveIterator($directory);

            foreach ($fileIterator as $matcherFile) {
                $name = $matcherFile->getPathname();

                if (preg_match(static::MATCHER_PATTERN, $name) === 0) {
                    continue;
                }

                $className = str_replace([realpath($directory) . "/", ".php"], ["", ""], realpath($name));
                $className = str_replace("/", "\\", $className);

                $reflection = new ReflectionClass($namespace . "\\" . $className);

                $this->loadFactoriesFromClass($reflection);
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
     * @throws AlreadyRegisteredException
     */
    private function loadFactoriesFromClass(ReflectionClass $reflectionClass)
    {
        $methods = $reflectionClass->getMethods();

        foreach($methods as $method) {
            $annotations = $this->getAnnotationsFromMethod($method);

            foreach ($annotations as $annotation) {
                $registerName = $annotation->getLookupName();
                $registerFactory = $annotation->getMethodFactory($method);

                $this->checkDuplicateKey($registerName);
                $this->factories->set($registerName, $registerFactory);
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
     * @param $registerName
     * @throws AlreadyRegisteredException
     */
    private function checkDuplicateKey($registerName) {

        if ($this->factories->containsKey($registerName) === false) {
            return;
        }

        $factory = $this->factories->get($registerName);
        $registeredMethod = $factory->get()->getMethod();

        throw new AlreadyRegisteredException($registerName, $registeredMethod);
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
