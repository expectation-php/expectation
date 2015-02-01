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
use expectation\matcher\Formatter;
use expectation\matcher\VariableMatcher;
use expectation\spec\helper\MatcherHelper;


describe('VariableMatcher', function() {

    beforeEach(function() {
        $this->matcher = new VariableMatcher(new Formatter());
        $this->matcherHelper = new MatcherHelper($this->matcher);
    });

    describe('#matchTruthy', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('matchTruthy');
            });
            it('have toBeTruthy', function() {
                Assertion::keyExists($this->annotations, 'toBeTruthy');
            });
        });
        context('when actual is true', function() {
            it('return true', function() {
                Assertion::true($this->matcher->matchTruthy(true));
            });
        });
        context('when actual is false', function() {
            it('return false', function() {
                Assertion::false($this->matcher->matchTruthy(false));
            });
        });
        context('when actual is blank', function() {
            it('return true', function() {
                Assertion::true($this->matcher->matchTruthy(''));
            });
        });
        context('when actual is null', function() {
            it('return false', function() {
                Assertion::false($this->matcher->matchTruthy(null));
            });
        });
        context('when actual is 0', function() {
            it('return true', function() {
                Assertion::true($this->matcher->matchTruthy(0));
            });
        });
    });

    describe('#matchFalsey', function() {
        describe('annotations', function() {
            beforeEach(function() {
                $this->annotations = $this->matcherHelper->getAnnotations('matchFalsey');
            });
            it('have toBeFalsey', function() {
                Assertion::keyExists($this->annotations, 'toBeFalsey');
            });
        });
        context('when actual is true', function() {
            it('return false', function() {
                Assertion::false($this->matcher->matchFalsey(true));
            });
        });
        context('when actual is false', function() {
            it('return true', function() {
                Assertion::true($this->matcher->matchFalsey(false));
            });
        });
        context('when actual is blank', function() {
            it('return false', function() {
                Assertion::false($this->matcher->matchFalsey(''));
            });
        });
        context('when actual is null', function() {
            it('return true', function() {
                Assertion::true($this->matcher->matchFalsey(null));
            });
        });
        context('when actual is 0', function() {
            it('return false', function() {
                Assertion::false($this->matcher->matchFalsey(0));
            });
        });
    });

    describe('#getFailureMessage', function() {
        context('when truthy', function() {
            it('should return the message on failure', function() {
                Assertion::false($this->matcher->matchTruthy(false));
                Assertion::same($this->matcher->getFailureMessage(), "Expected truthy value, got false");
            });
        });
        context('when falsey', function() {
            it('should return the message on failure', function() {
                Assertion::false($this->matcher->matchFalsey(true));
                Assertion::same($this->matcher->getFailureMessage(), "Expected falsey value, got true");
            });
        });
    });

    describe('#getNegatedFailureMessage', function() {
        context('when truthy', function() {
            it('should return the message on failure', function() {
                Assertion::true($this->matcher->matchTruthy(true));
                Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected falsey value, got true");
            });
        });
        context('when falsey', function() {
            it('should return the message on failure', function() {
                Assertion::true($this->matcher->matchFalsey(false));
                Assertion::same($this->matcher->getNegatedFailureMessage(), "Expected truthy value, got false");
            });
        });
    });

});
