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
     * @return void
     */
    public static function configure();


    /**
     * @param string $configurationFile
     * @return void
     */
    public static function configureWithFile($configurationFile);


    /**
     * @return Configuration
     */
    public static function configration();

}
