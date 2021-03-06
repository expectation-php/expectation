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

trait DSL
{

    /**
     * @param string $actual
     * @return Evaluator
     */
    public function expect($actual)
    {
        return Expectation::expect($actual);
    }

}
