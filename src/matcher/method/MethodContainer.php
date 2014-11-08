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

use expectation\matcher\reflection\ReflectionRegistryInterface;


/**
 * Class MethodContainer
 * @package expectation\matcher\method
 */
class MethodContainer implements MethodContainerInterface
{

    /**
     * @var ReflectionRegistryInterface
     */
    private $registry;


    /**
     * @param ReflectionRegistryInterface $registry
     */
    public function __construct(ReflectionRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param string $name
     * @return \expectation\matcher\MethodInterface
     */
    public function find($name, array $arguments)
    {
        $reflection = $this->registry->get($name);
        $factory = new MethodFactory($reflection);

        $method = $factory->createWithArguments($arguments);

        return $method;
    }

}
