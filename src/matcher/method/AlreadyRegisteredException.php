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

use Exception;
use ReflectionMethod;

class AlreadyRegisteredException extends Exception
{

    public function __construct($name, ReflectionMethod $method, $code = 0, Exception $previous = null)
    {
        $messages = [];
        $messages[] = "'%s' method of matcher is already registered.";
        $messages[] = "Class is %s, the method is registered with the %s.";

        $exceptionMessage = implode("\n", $messages);

        $className = $method->getDeclaringClass()->getName();
        $invokeMethodName = $method->getName();

        $resultMessage = sprintf($exceptionMessage, $name, $className, $invokeMethodName);

        parent::__construct($resultMessage, $code, $previous);
    }

}
