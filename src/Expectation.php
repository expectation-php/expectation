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
class Expectation implements ExpectationInterface, ConfiguratorInterface
{

    use Configurable;

    /**
     * @param mixed $actual
     * @return \expectation\Evaluator
     */
    public static function expect($actual)
    {
        $config = static::configration();
        $evaluator = new Evaluator($config->getMethodContainer());
        return $evaluator->that($actual);
    }

}
