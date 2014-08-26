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
use SplFileInfo;


/**
 * Class NamespaceReflection
 * @package expectation
 */
class NamespaceReflection
{

    const MATCHER_PATTERN = "/Matcher\\.php$/";


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

    /**
     * @return array
     */
    public function getClassReflections()
    {
        $reflections = [];

        $files = new RecursiveDirectoryIterator($this->namespaceDirectory);

        foreach ($files as $file) {
            if ($this->isMatcherClassFile($file) === false) {
                continue;
            }
            $className = $this->getClassFullNameFromFile($file);
            $reflections[] = new ReflectionClass($className);
        }

        return $reflections;
    }

    /**
     * @param SplFileInfo $file
     * @return bool
     */
    private function isMatcherClassFile(SplFileInfo $file)
    {
        return preg_match(static::MATCHER_PATTERN, $file->getPathname()) !== 0;
    }

    /**
     * @param SplFileInfo $file
     * @return mixed
     */
    private function getClassFullNameFromFile(SplFileInfo $file)
    {

        $className = str_replace([
            realpath($this->namespaceDirectory) . "/",
            ".php"
        ], ["", ""], realpath($file->getPathname()));

        $className = str_replace("/", "\\", $className);

        return $this->namespace . "\\" . $className;
    }

}
