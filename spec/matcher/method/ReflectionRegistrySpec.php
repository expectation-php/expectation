<?php

/**
 * This file is part of expectation package.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Assert\Assertion;
use \ReflectionMethod;
use expectation\matcher\method\ReflectionRegistry;
use expectation\matcher\method\ReflectionNotFoundException;
use expectation\matcher\method\AlreadyRegisteredException;
use \ArrayIterator;


describe('ReflectionRegistry', function() {
    beforeEach(function() {
        $this->method = new ReflectionMethod('\\expectation\\spec\\fixture\\matcher\\basic\\FixtureMatcher', 'match');
    });
    describe('#register', function() {
        context('when reflection registered', function() {
            beforeEach(function() {
                $this->registry = new ReflectionRegistry();
                $this->registry->register('toEquals', $this->method);
                $this->exceptionThrowed = false;

                try {
                    $this->registry->register('toEquals', $this->method);
                } catch (AlreadyRegisteredException $exception) {
                    $this->exceptionThrowed = true;
                }
            });
            it('throw AlreadyRegisteredException exception', function() {
                Assertion::true($this->exceptionThrowed);
            });
        });
    });

    describe('#registerAll', function() {
        beforeEach(function() {
            $this->registry = new ReflectionRegistry();
            $this->registry->registerAll(new ArrayIterator([
                'toEquals' => $this->method
            ]));
            $this->result = $this->registry->get('toEquals');
        });
        it('register all reflection', function() {
            Assertion::count($this->registry, 1);
        });
    });
    describe('#get', function() {
        context('when reflection registered', function() {
            beforeEach(function() {
                $this->registry = new ReflectionRegistry();
                $this->registry->registerAll(new ArrayIterator([
                    'toEquals' => $this->method
                ]));
                $this->result = $this->registry->get('toEquals');
            });
            it('register all reflection', function() {
                Assertion::same($this->result, $this->method);
            });
        });
        context('when reflection not registered', function() {
            beforeEach(function() {
                $this->exceptionThrowed = false;
                $this->registry = new ReflectionRegistry();

                try {
                    $this->registry->get('not found');
                } catch (ReflectionNotFoundException $exception) {
                    $this->exceptionThrowed = true;
                }
            });
            it('throw ReflectionNotFoundException exception', function() {
                Assertion::true($this->exceptionThrowed);
            });
        });
    });

});
