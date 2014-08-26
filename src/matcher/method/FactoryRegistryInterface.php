<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher\method;

/**
 * Interface FactoryRegistryInterface
 * @package expectation\matcher\method
 */
interface FactoryRegistryInterface
{

    /**
     * @param string $name
     * @param MethodFactoryInterface $factory
     * @throws \expectation\matcher\method\AlreadyRegisteredException
     */
    public function register($name, MethodFactoryInterface $factory);

    /**
     * @param string $name
     * @return MethodFactoryInterface
     * @throws \expectation\matcher\method\FactoryNotFoundException
     */
    public function get($name);

}
