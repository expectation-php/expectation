expectation
===========

**expectation** is the assertion library for unit testing.  
This library inspired by [pho](https://github.com/danielstjules/pho) of bdd test framework.

[![Build Status](https://travis-ci.org/holyshared/expectation.svg?branch=master)](https://travis-ci.org/holyshared/expectation)
[![Stories in Ready](https://badge.waffle.io/holyshared/expectation.png?label=ready&title=Ready)](https://waffle.io/holyshared/expectation)
[![Coverage Status](https://coveralls.io/repos/holyshared/expectation/badge.png?branch=master)](https://coveralls.io/r/holyshared/expectation?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/holyshared/expectation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/holyshared/expectation/?branch=master)
[![Dependencies Status](https://depending.in/holyshared/expectation.png)](http://depending.in/holyshared/expectation)

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
            "expectation/expectation": "dev-master"
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

To take advantage of the custom matcher, so that you can resolve the **ConfigrationBuilder** using the custom matcher.

	\expectation\Expectation::configure(function(ConfigrationBuilder $configBuilder) {
		$namespace = '\package\matcher';
		$directory = __DIR__ . '/matcher/';

		$configBuilder->registerMatcherNamespace($namespace, $directory);
	});

It is possible to make use of matcher as follows now.  
**toEql** is the method name that you specified in the annotation.

	expect(true)->toEql(true);


Domain specific language
---------------------------

You can use the **Domain specific language**.  
It is available by using the **ExpectationDSL** and **ExpectationDSLInterface**.

	use \expectation\ExpectationDSL;
	use \expectation\ExpectationDSLInterface;

	class TestCase implements ExpectationDSLInterface	{		use ExpectationDSL;		public function test()		{			$this->expect(true)->toBeTrue();		}	}