<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher;

interface MethodInterface
{

    /**
     * @param $expected
     * @return $this
     */
    public function setExpectValue($expected);

    /**
     * @param $actual
     * @return boolean
     * @throw \expectation\ExpectationException
     */
    public function positiveMatch($actual);

    /**
     * @param $actual
     * @return boolean
     * @throw \expectation\ExpectationException
     */
    public function negativeMatch($actual);

}
