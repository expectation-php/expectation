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

/**
 * Class ClassesSection
 * @package expectation\configuration\section
 */
final class ClassesSection extends AbstractSection implements SectionInterface
{

    /**
     * {@inheritdoc}
     */
    public function applyTo(ConfigurationBuilder $builder)
    {
        $matcherClassNames = $this->getMatcherClassNames();

        foreach($matcherClassNames as $matcherClassName) {
            $builder->registerMatcherClass($matcherClassName);
        }

        return $builder;
    }

    /**
     * @return array
     */
    private function getMatcherClassNames()
    {
        return $this->values;
    }

}
