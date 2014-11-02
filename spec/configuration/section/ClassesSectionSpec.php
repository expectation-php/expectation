<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use expectation\ConfigurationBuilder;
use expectation\configuration\section\ClassesSection;
use Assert\Assertion;

describe('ClassesSection', function() {
    describe('#applyTo', function() {
        beforeEach(function() {
            $this->builder = new ConfigurationBuilder();
            $this->section = new ClassesSection([
                'expectation\spec\fixture\matcher\basic\FixtureMatcher'
            ]);
            $this->section->applyTo($this->builder);
        });
        it("apply the config to builder", function() {
            $classes = $this->builder->getMatcherClasses();
            Assertion::count($classes, 1);
        });
    });
});
