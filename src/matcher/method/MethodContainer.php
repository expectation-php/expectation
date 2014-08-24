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
 * Class MethodContainer
 * @package expectation\matcher\method
 */
class MethodContainer implements MethodContainerInterface
{

    /**
     * @var FactoryRegistryInterface
     */
    private $registry;


    /**
     * @param FactoryRegistryInterface $factories
     */
    public function __construct(FactoryRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return \expectation\matcher\MethodInterface
     */
    public function find($name, array $arguments)
    {
        $factory = $this->registry->get($name);
        $method = $factory->withArguments($arguments);

        return $method;
    }

}
