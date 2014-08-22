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

use Countable;
use expectation\AbstractMatcher;
use expectation\matcher\annotation\Lookup;

/**
 * @package expectation
 * @property mixed $actualValue
 * @property mixed $expectValue
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class PrintMatcher extends AbstractMatcher
{

    /**
     * @Lookup(name="toPrint")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        ob_start();
        $actual();
        $this->actualValue = ob_get_clean();

        return ($this->actualValue === $this->expectValue);
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $actual = $this->formatter->toString($this->actualValue);
        $expected = $this->formatter->toString($this->expectValue);
        return "Expected {$expected}, got {$actual}";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        $expected = $this->formatter->toString($this->expectValue);
        return "Expected output other than {$expected}";
    }

}
