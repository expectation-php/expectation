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
use expectation\matcher\NamespaceReflection;

describe('NamespaceReflection', function() {

    describe('getClassReflections', function() {
        before(function() {
            $namespace = '\expectation\spec\fixture\matcher\single';
            $namespaceDirectory = __DIR__ . '/../fixture/matcher/single';

            $namespaceReflection = new NamespaceReflection($namespace, $namespaceDirectory);
            $this->classReflections = $namespaceReflection->getClassReflections();
        });
        it('return array', function() {
            Assertion::count($this->classReflections, 1);
        });
    });

});
