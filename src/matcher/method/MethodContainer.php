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
use expectation\matcher\MatcherNotFoundException;
use expectation\matcher\reflection\ReflectionNotFoundException;


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
     * {@inheritdoc}
     */
    public function find($name, array $arguments)
    {
        try {
            $reflection = $this->registry->get($name);
        } catch(ReflectionNotFoundException $exception) {
            throw new MatcherNotFoundException("Can not use a method called {$name}.", null, $exception);
        }

        $factory = new MethodFactory($reflection);
        $method = $factory->createWithArguments($arguments);

        return $method;
    }

}
