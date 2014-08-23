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
 * Class Configuration
 * @package expectation
 * @property-read mixed $methodContainer
 */
class Configuration
{

    use AttributeAccessible;

    /**
     * @var MatcherMethodContainerInterface
     */
    private $methodContainer;

    public function __construct(array $values)
    {
        foreach($values as $name => $value) {
            $this->$name = $value;
        }
    }

}
