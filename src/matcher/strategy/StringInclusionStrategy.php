<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher\strategy;

class StringInclusionStrategy
{

    /**
     * @var string
     */
    private $actualValue;

    /**
     * @param string actualValues
     */
    public function __construct($actualValue)
    {
        $this->actualValue = $actualValue;
    }

    /**
     * @param array expectValues
     */
    public function match(array $expectValues)
    {
        $matchResults = [];
        $unmatchResults = [];

        foreach ($expectValues as $expectValue) {
            $position = strpos($this->actualValue, $expectValue);

            if ($position !== false) {
                $matchResults[] = $expectValue;
            } else {
                $unmatchResults[] = $expectValue;
            }
        }

        return new InclusionResult($matchResults, $unmatchResults);
    }

}
