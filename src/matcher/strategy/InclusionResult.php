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
    private $matchResults;

    /**
     * @var array
     */
    private $unmatchResults;

    /**
     * @param array matchResults
     * @param array unmatchResults
     */
    public function __construct(array $matchResults, array $unmatchResults)
    {
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

}
