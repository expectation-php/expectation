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

/**
 * @package expectation
 */
class ConfigrationBuilder
{

    /**
     * @var array
     */
    private $matcherNamespaces;

    public function __construct()
    {
        $this->matcherNamespaces = [];
    }

    /**
     * @param string $namespace
     * @param string $directory
     * @return $this
     */
    public function registerMatcherNamespace($namespace, $directory)
    {
        $this->matcherNamespaces[$namespace] = $directory;
        return $this;
    }

    public function matcherNamespaces()
    {
        return $this->matcherNamespaces;
    }

    public function build()
    {
        $loader = new MethodLoader(new AnnotationReader());

        foreach ($this->matcherNamespaces as $namespace => $directory) {
            $loader->registerNamespace($namespace, $directory);
        }

        $config = new Configration([
            'methodContainer' => $loader->load()
        ]);

        return $config;
    }

}
