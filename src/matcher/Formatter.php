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


class Formatter
{

    public function toString($value)
    {
        if ($value === true) {
            return 'true';
        } else if ($value === false) {
            return 'false';
        } else if ($value === null) {
            return 'null';
        } else if (is_string($value)) {
            return "'" . $value . "'";
        }

        return rtrim(print_r($value, true));
    }

}
