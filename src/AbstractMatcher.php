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

use expectation\matcher\Formatter;


/**
 * Class AbstractMatcher
 * @package expectation
 * @property mixed $actualValue
 * @property mixed $expectValue
 */
abstract class AbstractMatcher implements MatcherInterface
{

    /**
     * @var mixed
     */
    private $actualValue;

    /**
     * @var mixed
     */
    private $expectValue;

    /**
     * @var Formatter
     */
    private $formatter;


    /**
     * @param Formatter $formatter
     */
    public function __construct(Formatter $formatter)
    {
        $this->setFormatter($formatter);
    }

    /**
     * @param Formatter $formatter
     */
    protected function setFormatter(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return Formatter
     */
    protected function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param mixed $actualValue
     */
    protected function setActualValue($actualValue)
    {
        $this->actualValue = $actualValue;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getActualValue()
    {
        return $this->actualValue;
    }

    /**
     * @param mixed $expected
     */
    public function setExpectValue($expected)
    {
        $this->expectValue = $expected;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function getExpectValue()
    {
        return $this->expectValue;
    }

}
