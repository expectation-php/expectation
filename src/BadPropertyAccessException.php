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

use Exception;

class BadPropertyAccessException extends Exception
{

    /**
     * @param string $name
     * @param int $code
     * @param null $previous
     */
    public function __construct($name, $code = 0, $previous = null)
    {
        $message = "Can not access a property {$name}.";
        parent::__construct($message, $code, $previous);
    }

}
