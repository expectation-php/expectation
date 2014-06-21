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

use expectation\matcher\MatcherContainerInterface;


class Expectation
{

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var boolean
     */
    private $negated = false;

    /**
     * @var \expectation\matcher\MatcherContainerInterface
     */
    private $container;

    public function __constrcut(MatcherContainerInterface $container) {
        $this->container = $container;
    }

    public function that($actual)
    {
        $this->actual = $actual;
        return $this;
    }

    public function not()
    {
        $this->negated = true;
        return $this;
    }

    public function __call($name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }

        $matcher = $this->container->find($name, $arguments);

        if ($this->negated) {
            $matcher->negativeMatch($this->actual);
        } else {
            $matcher->positiveMatch($this->actual);
        }
    }

}
