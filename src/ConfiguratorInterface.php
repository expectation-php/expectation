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

/**
 * @package expectation
 */
interface ConfiguratorInterface
{

    /**
     * @param callable $callback
     * @return void
     */
    public static function configure();

    /**
     * @return Configuration
     */
    public static function configration();

}
