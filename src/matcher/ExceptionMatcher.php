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

use Exception;
use expectation\AbstractMatcher;
use expectation\matcher\annotation\Lookup;

/**
 * @package expectation
 * @property mixed $actualValue
 * @property mixed $expectValue
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
class ExceptionMatcher extends AbstractMatcher
{

    /**
     * @var \Exception
     */
    private $thrownException;

    /**
     * @Lookup(name="toThrow")
     * @param mixed $actual
     * @return boolean
     */
    public function match($actual)
    {
        $this->setActualValue($actual);

        $callable = $this->getActualValue();
        $expected = $this->getExpectValue();

        try {
            $callable();
        } catch (Exception $exception) {
            $this->thrownException = $exception;
        }

        return $this->thrownException instanceof $expected;
    }

    /**
     * @return string
     */
    public function getFailureMessage()
    {
        $explanation = 'none thrown';

        if ($this->thrownException) {
            $class = get_class($this->thrownException);
            $explanation = "got $class";
        }

        return "Expected {$this->getExpectValue()} to be thrown, $explanation";
    }

    /**
     * @return string
     */
    public function getNegatedFailureMessage()
    {
        return "Expected {$this->getExpectValue()} not to be thrown";
    }

}
