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

interface InclusionStrategyInterface
{

    /**
     * @param array expectValues
     * @return \expectation\matcher\strategy\InclusionResult
     */
    public function match(array $expectValues);

}
