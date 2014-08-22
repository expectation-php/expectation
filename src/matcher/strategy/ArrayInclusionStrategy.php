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

class ArrayInclusionStrategy
{

    /**
     * @var array
     */
    private $actualValues;

    /**
     * @param array actualValues
     */
    public function __construct(array $actualValues)
    {
        $this->actualValues = $actualValues;
    }

    /**
     * @param array expectValues
     */
    public function match(array $expectValues)
    {
        $matchResults = [];
        $unmatchResults = [];

        foreach ($expectValues as $expectValue) {
            if (in_array($expectValue, $this->actualValues)) {
                $matchResults[] = $expectValue;
            } else {
                $unmatchResults[] = $expectValue;
            }
        }

        return new InclusionResult($expectValues, $matchResults, $unmatchResults);
    }

}
