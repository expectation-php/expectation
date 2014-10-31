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
 * Class NamespacesSection
 * @package expectation\configuration\section
 */
final class NamespacesSection extends AbstractSection implements SectionInterface
{

    /**
     * {@inheritdoc}
     */
    public function applyTo(ConfigurationBuilder $builder)
    {
    }

}
