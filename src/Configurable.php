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
     * @param callable $callback
     */
    public static function configure(callable $callback = null)
    {

        $builder = static::builder();

        if (isset($callback)) {
            call_user_func_array($callback, [$builder]);
        }

        static::$configuration = $builder->build();
    }

    /**
     * @return \expectation\Configuration
     */
    public static function configration()
    {
        return static::$configuration;
    }

    private static function builder()
    {
        $builder = new ConfigurationBuilder();
        $builder->registerMatcherNamespace(
            '\\expectation\\matcher',
            __DIR__ . '/matcher'
        );

        return $builder;
    }

}
