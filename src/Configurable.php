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
     * @var \expectation\Configration
     */
    private static $configration;

    /**
     * @param callable $callback
     */
    public static function configure(callable $callback)
    {
        if (!empty(static::$configration)) {
            return;
        }
        $builder = static::builder();
        call_user_func_array($callback, [$builder]);

        static::$configration = $builder->build();
    }

    /**
     * @return \expectation\Configration
     */
    public static function configration()
    {
        return static::$configration;
    }

    private static function builder()
    {
        $builder = new ConfigrationBuilder();
        $builder->registerMatcherNamespace(
            '\\expectation\\matcher',
            __DIR__ . '/matcher'
        );

        return $builder;
    }

}
