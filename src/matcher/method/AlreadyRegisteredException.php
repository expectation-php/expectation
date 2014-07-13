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

class AlreadyRegisteredException extends Exception
{

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $exceptionMessage = "'%s' method of matcher is already registered";
        $resultMessage = sprintf($exceptionMessage, $message);

        parent::__construct($resultMessage, $code, $previous);
    }

}
