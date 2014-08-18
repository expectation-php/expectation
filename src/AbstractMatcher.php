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
use expectation\AttributeAccessible;

/**
 * Class AbstractMatcher
 * @package expectation
 * @property mixed $actualValue
 * @property mixed $expectValue
 */
abstract class AbstractMatcher implements MatcherInterface
{

    use AttributeAccessible;

    /**
     * @var mixed
     */
    protected $actualValue;

    /**
     * @var mixed
     */
    private $expectValue;

    /**
     * @var Formatter
     */
    private $formatter;


    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
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
    public function getActualValue()
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
    public function getExpectValue()
    {
        return $this->expectValue;
    }

}
