<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\matcher\annotation;

use ReflectionMethod;
use expectation\BadPropertyAccessException;
use expectation\matcher\method\MethodFactory;
use expectation\matcher\AnnotationInterface;

/**
 * @Annotation
 * @Target({"METHOD"})
 * @Attributes(
 *   @Attribute("name", required = true, type = "string")
 * )
 *
 * @package expectation\matcher\annotation
 * @author Noritaka Horio <holy.shared.design@gmail.com>
 */
final class Lookup implements AnnotationInterface
{

    /**
     * @var string
     */
    private $name;

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        foreach($values as $name => $value) {
            if (!property_exists($this, $name)) {
                throw new BadPropertyAccessException($name);
            }
            $this->$name = $value;
        }
    }

    /**
     * @return string
     */
    public function getLookupName()
    {
        return $this->name;
    }

}
