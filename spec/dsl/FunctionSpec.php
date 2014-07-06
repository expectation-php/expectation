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
use expectation\dsl as expectation;
use expectation\Expectation as AliasExpectation;
use expectation\ConfigrationBuilder;
use stdClass;
use RuntimeException;
use ArrayObject;

describe('DSL', function() {
    before(function() {
        AliasExpectation::configure(function(ConfigrationBuilder $config) {
            $config->registerMatcherNamespace(
                'expectation\spec\fixture',
                __DIR__ . '/../fixture'
            );
        });
    });

    describe('equal matcher', function() {
        describe('toEqual', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(true)->toEqual(true));
                });
            });
        });
        describe('toBeTrue', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(true)->toBeTrue());
                });
            });
        });
        describe('toBeFalse', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(false)->toBeFalse());
                });
            });
        });
        describe('toBeNull', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(null)->toBeNull());
                });
            });
        });
    });


    describe('type matcher', function() {
        describe('toBeA', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect('foo')->toBeA('string'));
                });
            });
        });
        describe('toBeAn', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect('foo')->toBeAn('string'));
                });
            });
        });
        describe('toBeString', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect('true')->toBeString());
                });
            });
        });
        describe('toBeInteger', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(1)->toBeInteger());
                });
            });
        });
        describe('toBeFloat', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(1.1)->toBeFloat());
                });
            });
        });
        describe('toBeDouble', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(1.1)->toBeDouble());
                });
            });
        });
        describe('toBeBoolean', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(true)->toBeBoolean());
                });
            });
        });
    });

    describe('instance matcher', function() {
        describe('toBeAnInstanceOf', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(new stdClass())->toBeAnInstanceOf('stdClass'));
                });
            });
        });
    });

    describe('exception matcher', function() {
        describe('toThrow', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    $result = expectation\expect(function() {
                        throw new RuntimeException();
                    })->toThrow('RuntimeException');
                    Assertion::true($result);
                });
            });
        });
    });

    describe('length matcher', function() {
        describe('toHaveLength', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect([1])->toHaveLength(1));
                    Assertion::true(expectation\expect("a")->toHaveLength(1));
                    Assertion::true(expectation\expect(new ArrayObject([1]))->toHaveLength(1));
                });
            });
        });
    });

    describe('print matcher', function() {
        describe('toPrint', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect(function() {
                        echo 'foo';
                    })->toPrint('foo'));
                });
            });
        });
    });

    describe('pattern matcher', function() {
        describe('toStartWith', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect("foobar")->toStartWith("foo"));
                });
            });
        });
        describe('toEndWith', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect("barfoo")->toEndWith("foo"));
                });
            });
        });
        describe('toMatch', function() {
            context('when result is true', function() {
                it('should return true', function() {
                    Assertion::true(expectation\expect("barfoo")->toMatch("/foo/"));
                });
            });
        });
    });

});
