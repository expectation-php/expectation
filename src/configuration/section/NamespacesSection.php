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
use expectation\configuration\AbstractSection;
use expectation\configuration\SectionInterface;
use Eloquent\Pathogen\AbsolutePath;
use Eloquent\Pathogen\RelativePath;


/**
 * Class NamespacesSection
 * @package expectation\configuration\section
 */
final class NamespacesSection extends AbstractSection implements SectionInterface
{

    public function assembleBy($composerJsonDirectory)
    {
        $assemblePaths = [];

        $matcherNamespaces = $this->getMatcherNamespaces();
        $rootDirectoryPath = AbsolutePath::fromString($composerJsonDirectory);

        foreach ($matcherNamespaces as $namespace => $directory) {
            $relativePath = RelativePath::fromString($directory);
            $matcherDirectory = $rootDirectoryPath->resolve($relativePath);
            $assemblePaths[$namespace] = (string) $matcherDirectory->normalize();
        }

        $this->values = $assemblePaths;
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
        return $this->values;
    }

}
