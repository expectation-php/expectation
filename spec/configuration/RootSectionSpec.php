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
use expectation\configuration\RootSection;
use Assert\Assertion;
use Prophecy\Prophet;
use Prophecy\Argument;


describe('RootSection', function() {
    describe('#applyTo', function() {
        beforeEach(function() {
            $this->builder = new ConfigurationBuilder();
            $this->prophet = new Prophet();

            $section1 = $this->prophet->prophesize('expectation\configuration\SectionInterface');
            $section1->applyTo(Argument::exact($this->builder))->shouldBeCalled();
            $this->section1 = $section1->reveal();

            $section2 = $this->prophet->prophesize('expectation\configuration\SectionInterface');
            $section2->applyTo(Argument::exact($this->builder))->shouldBeCalled();
            $this->section2 = $section2->reveal();

            $this->section = new RootSection([
                $this->section1, $this->section2
            ]);
            $this->result = $this->section->applyTo($this->builder);
        });
        it("apply the config to builder", function() {
            $this->prophet->checkPredictions();
        });
        it("return expectation\ConfigurationBuilder instance", function() {
            Assertion::same($this->result, $this->builder);
        });
    });
});
