<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher\method;

interface MethodFactoryInterface
{

    /**
     * @param array $arguments
     * @return \expectation\matcher\Method
     */
    public function withArguments(array $arguments);

    /**
     * @return ReflectionMethod
     */
    public function getMethod();

}
