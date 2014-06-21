<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Preview\DSL\BDD;

use Assert\Assertion;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use expectation\MatcherLoader;

describe('MatcherLoader', function() {

    before(function() {
        $this->reader = new AnnotationReader();
        AnnotationRegistry::registerAutoloadNamespace('expectation\\matcher\\annotation\\', realpath(__DIR__ . '/../'));
    });

    describe('load', function() {
        before(function() {
            $this->loader = new MatcherLoader($this->reader);
            $this->loader->registerNamespace('expectation\spec\fixture', __DIR__ . '/fixture');
            $this->container = $this->loader->load();
        });
        it('should return expectation\MatcherContainerInterface instance', function() {
            Assertion::isInstanceOf($this->container, 'expectation\MatcherContainerInterface');
        });
    });

});
