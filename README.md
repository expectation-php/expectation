Expectation
===========

**expectation** is the assertion library for unit testing.  
This library inspired by [pho](https://github.com/danielstjules/pho) of bdd test framework.

[![Build Status](https://travis-ci.org/expectation-php/expectation.svg?branch=master)](https://travis-ci.org/expectation-php/expectation)
[![Stories in Ready](https://badge.waffle.io/expectation-php/expectation.svg?label=ready&title=Ready)](http://waffle.io/expectation-php/expectation)
[![Coverage Status](https://coveralls.io/repos/expectation-php/expectation/badge.png)](https://coveralls.io/r/expectation-php/expectation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/expectation-php/expectation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/expectation-php/expectation/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/545032df9fc4d53c65000294/badge.svg?style=flat)](https://www.versioneye.com/user/projects/545032df9fc4d53c65000294)

* [Requirements](#requirements)
* [Installation](#installation)
* [Basic usage](#basic-usage)
* [Basic matchers](#basic-matchers)
* [Custom matchers](#custom-matchers)
* [Domain specific language](#domain-specific-language)


Requirements
---------------------------
* PHP >= 5.4


Installation
---------------------------

Please add the following items to **composer.json**.  
Then please run the **composer install**.

    {
        "require-dev": {
            "expectation/expectation": "1.3.1"
        }
    }

Basic usage
---------------------------

There is a need to set up to be able to use it.

	\expectation\Expectation::configure();

Use example is as follows.

	expect(1)->toEqual(1);
	expect(true)->toBeTrue();
	expect(true)->toBeFalse();

Basic matchers
---------------------------

### Equal matching

    expect('foo')->toEqual('foo'); //pass
    expect(1)->toEqual(1); //pass
    expect(new stdClass())->toEqual(new stdClass()); //fail

    expect(true)->toBeTrue();   //pass
    expect(false)->toBeFalse();   //pass
    expect(null)->toBeNull();   //pass

### Type matching

    expect('foo')->toBeA('string');
    expect('foo')->toBeAn('string');
    expect('true')->toBeString();
    expect(1)->toBeInteger();
    expect(1.1)->toBeFloat();
    expect(1.1)->toBeDouble();
    expect(true)->toBeBoolean();

### Exception matching

    expect(function() {
	    throw new RuntimeException();
    })->toThrow('RuntimeException');

### Length matching

    expect([1])->toHaveLength(1);
    expect("a")->toHaveLength(1);
    expect(new ArrayObject([1]))->toHaveLength(1);

### Print matching

    expect(function() {
	    echo 'foo';
    })->toPrint('foo'); //pass

### Inclusion matching

	expect("barfoo")->toContain("foo");
	expect("foo")->toContain(["foo", "fo"]);
	expect(["bar", "foo"])->toContain("foo");
	expect(["bar", "foo"])->toContain(["bar", "foo"]);
	expect(["bar", "foo"])->toContain("bar", "foo");
	expect(["foo" => "bar"])->toHaveKey("foo");

### Numeric matching

	expect(4)->toBeGreaterThan(3);
	expect(2)->toBeLessThan(3);
	expect(2)->toBeWithin(1, 3);


Custom matchers
---------------------------

Please inherited the **AbstractMatcher** If you want to create a matcher.
And please implement the method **match**, **getFailureMessage**, of **getNegatedFailureMessage**.

Please use the **Lookup annotations** always in the match method.

	use expectation\AbstractMatcher;
	use expectation\matcher\annotation\Lookup;

	class StrictEqualMatcher extends AbstractMatcher
	{

    	/**
	     * @Lookup(name="toEql")
	     * @param mixed $actual
	     */
	    public function match($actual)
	    {
	        $this->actualValue = $actual;
	        return $this->expectValue === $this->actualValue;
	    }

	    /**
	     * @return string
	     */
	    public function getFailureMessage()
	    {
	        $actual = $this->formatter->toString($this->actualValue);
	        $expected = $this->formatter->toString($this->expectValue);
	        return "Expected {$actual} to be {$expected}";
	    }

	    /**
	     * @return string
	     */
	    public function getNegatedFailureMessage()
	    {
	        $actual = $this->formatter->toString($this->actualValue);
	        $expected = $this->formatter->toString($this->expectValue);
	        return "Expected {$actual} not to be {$expected}";
	    }

	}

To take advantage of the custom matcher, so that you can resolve the **ConfigurationBuilder** using the custom matcher.

	\expectation\Expectation::configure(function(ConfigurationBuilder $configBuilder) {
		$namespace = '\package\matcher';
		$directory = __DIR__ . '/matcher/';

		$configBuilder->registerMatcherNamespace($namespace, $directory);
	});

or

	\expectation\Expectation::configure(function(ConfigurationBuilder $configBuilder) {
		$configBuilder->registerMatcherClass('\package\matcher\StrictEqualMatcher');
	});

It is possible to make use of matcher as follows now.  
**toEql** is the method name that you specified in the annotation.

	expect(true)->toEql(true);


Domain specific language
---------------------------

You can use the **Domain specific language**.  
It is available by using the **DSL** and **DSLInterface**.

	use \expectation\DSL;
	use \expectation\DSLInterface;

	class TestCase implements DSLInterface
	{

		use DSL;

		public function test()
		{
			$this->expect(true)->toBeTrue();
		}

	}

Run unit test
---------------------------

	composer test
