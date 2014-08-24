<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher;

use ReflectionClass;
//use RecursiveIteratorIterator;
//use RecursiveDirectoryIterator;/
//use FilesystemIterator;


/**
 * Class NamespaceReflection
 * @package expectation
 */
class NamespaceReflection
{

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $namespaceDirectory;

    /**
     * @param string $namespace
     * @param string $namespaceDirectory
     */
    public function __construct($namespace, $namespaceDirectory)
    {
        $this->namespace = $namespace;
        $this->namespaceDirectory = $namespaceDirectory;
    }

    public function getClassReflections()
    {
        $reflections = [];

        $files = new RecursiveDirectoryIterator($this->namespaceDirectory);

        foreach ($files as $file) {
            $name = $file->getPathname();

            $className = str_replace([realpath($this->namespaceDirectory) . "/", ".php"], ["", ""], realpath($name));
            $className = str_replace("/", "\\", $className);

            $reflections[] = new ReflectionClass($this->namespace . "\\" . $className);
        }

        return $reflections;
    }

}
