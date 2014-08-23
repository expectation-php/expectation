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
        if (is_bool($value)) {
            return $this->booleanToString($value);
        } else if (is_null($value)) {
            return 'null';
        } else if (is_string($value)) {
            return "'" . $value . "'";
        }

        return rtrim(print_r($value, true));
    }

    /**
     * @param boolean $value
     * @return string
     */
    private function booleanToString($value)
    {
        return ($value) ? 'true' : 'false';
    }

}
