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
use expectation\matcher\EqualMatcher;
use expectation\matcher\Formatter;
use expectation\matcher\reflection\ReflectionLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use \ReflectionClass;


describe('EqualMatcher', function() {

    beforeEach(function() {
        $this->loader = new ReflectionLoader(new AnnotationReader());
        $this->matcher = new EqualMatcher(new Formatter());
        $this->matcherClass = new ReflectionClass($this->matcher);
    });

    describe('annotations', function() {
        beforeEach(function() {
            $reflections = $this->loader->loadFromClass($this->matcherClass);
            $this->reflections = $reflections->getArrayCopy();
        });
        it('have toEqual', function() {
            Assertion::keyExists($this->reflections, 'toEqual');
        });
        it('have toBe', function() {
            Assertion::keyExists($this->reflections, 'toBe');
        });
        it('have toBeTrue', function() {
            Assertion::keyExists($this->reflections, 'toBeTrue');
        });
        it('have toBeFalse', function() {
            Assertion::keyExists($this->reflections, 'toBeFalse');
        });
        it('have toBeNull', function() {
            Assertion::keyExists($this->reflections, 'toBeNull');
        });
    });

    describe('#match', function() {
        context('when same value', function() {
            it('should return true', function() {
                $result = $this->matcher->setExpectValue(true)->match(true);
                Assertion::true($result);
            });
        });
        context('when not same value', function() {
            it('should return false', function() {
                $result = $this->matcher->setExpectValue(false)->match(true);
                Assertion::false($result);
            });
        });
    });

    describe('#matchTrue', function() {
        it('should return true', function() {
            Assertion::true($this->matcher->matchTrue(true));
        });
    });

    describe('#matchFalse', function() {
        it('should return true', function() {
            Assertion::true($this->matcher->matchFalse(false));
        });
    });

    describe('#matchNull', function() {
        it('should return true', function() {
            Assertion::true($this->matcher->matchNull(null));
        });
    });

    describe('#getFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::false($this->matcher->setExpectValue('foo')->match('bar'));
            Assertion::same($this->matcher->getFailureMessage(), "Expected 'bar' to be 'foo'");
        });
    });

    describe('#getNegatedFailureMessage', function() {
        it('should return the message on failure', function() {
            Assertion::true($this->matcher->setExpectValue('foo')->match('foo'));
            Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected 'foo' not to be 'foo'");
        });
    });

});
