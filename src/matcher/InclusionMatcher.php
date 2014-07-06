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

use expectation\AbstractMatcher;
use expectation\matcher\annotation\Lookup;

/**
 * @package expectation\matcher
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class InclusionMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toContain")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $result = false;
        $included = false;
        $expectValues = (is_array($this->expectValue))
            ? $this->expectValue : [$this->expectValue];

        $this->actualValue = $actual;

        if (is_string($this->actualValue)) {
            foreach($expectValues as $expectValue) {
                $result = strpos($this->actualValue, $expectValue);
                if ($result === false) {
                    continue;
                }
                $included = true;
                break;
            }
            $result = $included;

        } else if (is_array($this->actualValue)) {
            foreach($expectValues as $expectValue) {
                $result = in_array($expectValue, $this->actualValue);
                if ($result === false) {
                    continue;
                }
                $included = true;
                break;
            }
            $result = $included;
        }

        return $result;
    }

    /**
     * @Lookup(name="toHaveKey")
     * @param mixed $actual
     * @return boolean
     */
    public function containsKey($actual)
    {
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
    }

}
