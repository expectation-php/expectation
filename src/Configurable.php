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
trait Configurable
{

    /**
     * @var \expectation\Configuration
     */
    private static $configuration;

    /**
     * {@inheritdoc}
     */
    public static function configure()
    {
        $builder = new ConfigurationBuilder();
        self::$configuration = $builder->build();
    }

    /**
     * {@inheritdoc}
     */
    public static function configureWithFile($configurationFile)
    {
        $loader = new ConfigurationLoader();
        self::$configuration = $loader->load($configurationFile);
    }


    /**
     * {@inheritdoc}
     */
    public static function configration()
    {
        return self::$configuration;
    }

}
