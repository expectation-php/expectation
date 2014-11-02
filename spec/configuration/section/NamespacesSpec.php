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
use expectation\configuration\section\NamespacesSection;
use Assert\Assertion;


describe('NamespacesSection', function() {
    describe('#applyTo', function() {
        beforeEach(function() {
            $this->builder = new ConfigurationBuilder();
            $this->section = new NamespacesSection([
                'expectation\spec\fixture\matcher\single' => __DIR__ . '/../../fixture/matcher/single'
            ]);
            $this->section->applyTo($this->builder);
        });
        it("apply the config to builder", function() {
            $namespaces = $this->builder->getMatcherNamespaces();
            Assertion::count($namespaces, 2);
        });
    });
});
