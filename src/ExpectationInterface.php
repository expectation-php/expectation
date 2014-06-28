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

interface ExpectationInterface
{

    /**
     * @param mixed $actual
     * @return $this
     */
    public function that($actual);

    /**
     * @return $this
     */
    public function not();

}
