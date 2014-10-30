<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\configuration;

use expectation\ConfigurationBuilder;

/**
 * Interface SectionInterface
 * @package expectation\configuration
 */
interface SectionInterface
{

    /**
     * @param ConfigurationBuilder $builder
     * @return ConfigurationBuilder
     */
    public function applyTo(ConfigurationBuilder $builder);

}
