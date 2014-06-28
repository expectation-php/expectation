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
     */
    public static function configure(callable $callback);

    /**
     * @return \expectation\Configration
     */
    public static function configration();

}
