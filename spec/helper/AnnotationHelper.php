<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace expectation\spec\helper;

use expectation\matcher\annotation\Lookup;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use \ReflectionMethod;


/**
 * Class AnnotationHelper
 * @package expectation\spec\helper
 */
class AnnotationHelper
{

    /**
     * @var Reader
     */
    private $annotationReader;


    public function __construct()
    {
        $this->annotationReader = new AnnotationReader();
    }


    public function getLookupAnnotations(ReflectionMethod $reflection)
    {
        $lookupAnnotations = [];
        $annotations = $this->annotationReader->getMethodAnnotations($reflection);

        foreach ($annotations as $annotation) {
            if (($annotation instanceof Lookup) === false) {
                continue;
            }
            $key = $annotation->getLookupName();
            $lookupAnnotations[$key] = $annotation;
        }

        return $lookupAnnotations;
    }

}
