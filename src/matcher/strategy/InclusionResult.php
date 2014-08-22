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

class InclusionResult
{

    /**
     * @var array
     */
    private $expectValues;

    /**
     * @var array
     */
    private $matchResults;

    /**
     * @var array
     */
    private $unmatchResults;

    /**
     * @param array expectValues
     * @param array matchResults
     * @param array unmatchResults
     */
    public function __construct(array $expectValues, array $matchResults, array $unmatchResults)
    {
        $this->expectValues = $expectValues;
        $this->matchResults = $matchResults;
        $this->unmatchResults = $unmatchResults;
    }

    /**
     * @return array
     */
    public function getMatchResults()
    {
        return $this->matchResults;
    }

    /**
     * @return array
     */
    public function getUnmatchResults()
    {
        return $this->unmatchResults;
    }

    /**
     * @return boolean
     */
    public function isMatched()
    {
        return count($this->matchResults) >= count($this->expectValues);
    }

}
