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

use SplStack;

class MatcherContainer implements MatcherContainerInterface
{

    /**
     * @var SplStack
     */
    private $container;


    public function __construct(SplStack $container)
    {
        $this->container = $container;
    }

    /**
     * @return \expectation\matcher\MatcherInterface
     */
    public function find($name, array $arguments)
    {
        $this->container->rewind();

        while($this->container->valid()) {
            $lookUpKey = $this->container->key();
            if ($lookUpKey !== $name) {
                continue;
            }
            $factory = $this->container->current();
        }

        return $factory->newInstanceWtih($arguments);
    }

}
