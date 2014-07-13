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

/**
 * @package expectation
 */
class ConfigurationBuilder
{

    /**
     * @var \PhpCollection\Map
     */
    private $matcherNamespaces;

    public function __construct()
    {
        $this->matcherNamespaces = new Map();
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
    public function matcherNamespaces()
    {
        return $this->matcherNamespaces;
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

        $config = new Configuration([
            'methodContainer' => $loader->load()
        ]);

        return $config;
    }

}
