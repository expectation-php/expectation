<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\configuration\section;

use expectation\ConfigurationBuilder;
use expectation\configuration\SectionInterface;
use Eloquent\Pathogen\AbsolutePath;
use Eloquent\Pathogen\RelativePath;


/**
 * Class NamespacesSection
 * @package expectation\configuration\section
 */
final class NamespacesSection implements SectionInterface
{

    /**
     * @var string
     */
    private $rootDirectory;


    /**
     * @var array
     */
    private $namespacePaths;


    /**
     * @param array $values
     */
    public function __construct(array $values, $composerJsonDirectory)
    {
        $this->rootDirectory = $composerJsonDirectory;
        $this->assembleNamespaces($values);
    }

    /**
     * @param array $matcherNamespaces
     * @throws \Eloquent\Pathogen\Exception\NonAbsolutePathException
     * @throws \Eloquent\Pathogen\Exception\NonRelativePathException
     */
    private function assembleNamespaces(array $matcherNamespaces)
    {
        $assemblePaths = [];
        $rootDirectoryPath = AbsolutePath::fromString($this->rootDirectory);

        foreach ($matcherNamespaces as $namespace => $directory) {
            $relativePath = RelativePath::fromString($directory);
            $matcherDirectory = $rootDirectoryPath->resolve($relativePath);
            $assemblePaths[$namespace] = (string) $matcherDirectory->normalize();
        }

        $this->namespacePaths = $assemblePaths;
    }


    /**
     * {@inheritdoc}
     */
    public function applyTo(ConfigurationBuilder $builder)
    {
        $matcherNamespaces = $this->getMatcherNamespaces();

        foreach($matcherNamespaces as $matcherNamespace => $directoryPath) {
            $builder->registerMatcherNamespace($matcherNamespace, $directoryPath);
        }

        return $builder;
    }

    /**
     * @return array
     */
    private function getMatcherNamespaces()
    {
        return $this->namespacePaths;
    }

}
