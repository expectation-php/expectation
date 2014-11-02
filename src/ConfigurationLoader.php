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
use expectation\configuration\RootSection;
use expectation\configuration\section\ClassesSection;
use expectation\configuration\section\NamespacesSection;


/**
 * Class ConfigurationLoader
 * @package expectation
 */
class ConfigurationLoader
{

    /**
     * @var \expectation\ConfigurationBuilder
     */
    private $builder;

    /**
     * @var \expectation\configuration\RootSection
     */
    private $rootSection;

    /**
     * @var \PhpCollection\Map
     */
    private $configValues;


    public function __construct()
    {
        $this->builder = new ConfigurationBuilder();
        $this->rootSection = new RootSection();
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
        $classes = $this->configValues->get('classes');

        if ($classes->isEmpty()) {
            return;
        }

        $section = new ClassesSection( $classes->get() );
        $this->rootSection->addSection($section);
    }

    private function applyNamespaceSection()
    {
        $namespaces = $this->configValues->get('namespaces');

        if ($namespaces->isEmpty()) {
            return;
        }

        $section = new NamespacesSection( $namespaces->get() );
        $this->rootSection->addSection($section);
    }

    /**
     * @return Configuration
     */
    private function createConfiguration()
    {
        $this->rootSection->applyTo($this->builder);
        return $this->builder->build();
    }

}
