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

use expectation\matcher\AnnotationInterface;
use expectation\Populatable;


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

    use Populatable;


    /**
     * @var string
     */
    private $name;

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->populate($values);
    }

    /**
     * @return string
     */
    public function getLookupName()
    {
        return $this->name;
    }

}
