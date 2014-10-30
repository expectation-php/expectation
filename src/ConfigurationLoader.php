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

use PhpCollection\Map;


/**
 * Class ConfigurationLoader
 * @package expectation
 */
class ConfigurationLoader
{

    /**
     * @var ConfigurationBuilder
     */
    private $builder;

    /**
     * @var \PhpCollection\Map
     */
    private $configValues;


    public function __construct()
    {
        $this->builder = new ConfigurationBuilder();
    }


    /**
     * @param string $configurationFilePath
     * @return Configuration
     */
    public function load($configurationFilePath)
    {
        $this->loadConfiguration($configurationFilePath);
        $this->applyClassSection();
        $this->applyNamespaceSection();

        return $this->createConfiguration();
    }

    /**
     * @param string $configurationFilePath
     */
    private function loadConfiguration($configurationFilePath)
    {
        $configValues = include $configurationFilePath;
        $this->configValues = new Map($configValues);
    }

    private function applyClassSection()
    {
        if ($this->configValues->containsKey('classes') === false) {
            return;
        }

        $matcherClassNames = $this->configValues->get('classes');

        foreach ($matcherClassNames->get() as $matcherClassName) {
            $this->builder->registerMatcherClass($matcherClassName);
        }
    }

    private function applyNamespaceSection()
    {
        if ($this->configValues->containsKey('namespaces') === false) {
            return;
        }
        $matcherNamespaces = $this->configValues->get('namespaces');

        foreach ($matcherNamespaces->get() as $matcherNamespace => $matcherDirectory) {
            $this->builder->registerMatcherNamespace($matcherNamespace, $matcherDirectory);
        }
    }

    /**
     * @return Configuration
     */
    private function createConfiguration()
    {
        return $this->builder->build();
    }

}
