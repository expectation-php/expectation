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

use expectation\configuration\RootSection;
use expectation\configuration\section\NamespacesSection;
use expectation\configuration\ConfigurationFileNotFoundException;
use Noodlehaus\Config;
use Eloquent\Pathogen\AbsolutePath;


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
     * @var \Noodlehaus\Config
     */
    private $configValues;

    /**
     * @var \Eloquent\Pathogen\AbsolutePath
     */
    private $composerJsonPath;


    public function __construct()
    {
        $this->builder = new ConfigurationBuilder();
        $this->rootSection = new RootSection();
    }

    /**
     * @param string $composerJson
     * @return Configuration
     */
    public function load($composerJson)
    {
        $this->loadConfiguration($composerJson);
        $this->applyNamespaceSection();

        return $this->createConfiguration();
    }

    /**
     * @param string $composerJson
     * @throws \Eloquent\Pathogen\Exception\NonAbsolutePathException
     */
    private function loadConfiguration($composerJson)
    {
        if (file_exists($composerJson) === false) {
            throw new ConfigurationFileNotFoundException("File $composerJson not found");
        }

        $this->configValues = new Config($composerJson);
        $this->composerJsonPath = AbsolutePath::fromString($composerJson);
    }

    private function applyNamespaceSection()
    {
        $composerJsonDirectoryPath = $this->composerJsonPath->parent()->normalize();
        $namespaces = $this->configValues->get('extra.expectation.namespaces', []);

        $section = new NamespacesSection($namespaces, (string) $composerJsonDirectoryPath);
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
