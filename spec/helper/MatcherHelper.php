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

use expectation\MatcherInterface;
use expectation\matcher\annotation\Lookup;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use \ReflectionClass;
use \ReflectionMethod;


/**
 * Class MatcherHelper
 * @package expectation\spec\helper
 */
class MatcherHelper
{

    /**
     * @var ReflectionClass
     */
    private $matcher;

    /**
     * @var Reader
     */
    private $annotationReader;


    public function __construct(MatcherInterface $matcher)
    {
        $this->matcher = new ReflectionClass($matcher);
        $this->annotationReader = new AnnotationReader();
    }

    public function getAnnotations($method)
    {
        $method = $this->matcher->getMethod($method);
        return $this->parseAnnotations($method);
    }


    /**
     * @param ReflectionMethod $reflection
     * @return array
     */
    private function parseAnnotations(ReflectionMethod $reflection)
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
