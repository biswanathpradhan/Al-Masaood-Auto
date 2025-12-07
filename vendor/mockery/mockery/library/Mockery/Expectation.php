<?php
<<<<<<< HEAD
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/blob/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
=======

/**
 * Mockery (https://docs.mockery.io/)
 *
 * @copyright https://github.com/mockery/mockery/blob/HEAD/COPYRIGHT.md
 * @license https://github.com/mockery/mockery/blob/HEAD/LICENSE BSD 3-Clause License
 * @link https://github.com/mockery/mockery for the canonical source repository
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
 */

namespace Mockery;

use Closure;
<<<<<<< HEAD
use Mockery\Matcher\NoArgs;
use Mockery\Matcher\AnyArgs;
use Mockery\Matcher\AndAnyOtherArgs;
use Mockery\Matcher\ArgumentListMatcher;
use Mockery\Matcher\MultiArgumentClosure;

class Expectation implements ExpectationInterface
{
    /**
     * Mock object to which this expectation belongs
     *
     * @var \Mockery\LegacyMockInterface
=======
use Hamcrest\Matcher;
use Hamcrest_Matcher;
use InvalidArgumentException;
use Mockery;
use Mockery\CountValidator\AtLeast;
use Mockery\CountValidator\AtMost;
use Mockery\CountValidator\Exact;
use Mockery\Matcher\AndAnyOtherArgs;
use Mockery\Matcher\AnyArgs;
use Mockery\Matcher\ArgumentListMatcher;
use Mockery\Matcher\MatcherInterface;
use Mockery\Matcher\MultiArgumentClosure;
use Mockery\Matcher\NoArgs;
use OutOfBoundsException;
use PHPUnit\Framework\Constraint\Constraint;
use Throwable;

use function array_key_exists;
use function array_search;
use function array_shift;
use function array_slice;
use function count;
use function current;
use function func_get_args;
use function get_class;
use function in_array;
use function is_array;
use function is_int;
use function is_object;
use function is_string;
use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

class Expectation implements ExpectationInterface
{
    public const ERROR_ZERO_INVOCATION = 'shouldNotReceive(), never(), times(0) chaining additional invocation count methods has been deprecated and will throw an exception in a future version of Mockery';

    /**
     * Actual count of calls to this expectation
     *
     * @var int
     */
    protected $_actualCount = 0;

    /**
     * Exception message
     *
     * @var null|string
     */
    protected $_because = null;

    /**
     * Array of closures executed with given arguments to generate a result
     * to be returned
     *
     * @var array
     */
    protected $_closureQueue = [];

    /**
     * The count validator class to use
     *
     * @var string
     */
    protected $_countValidatorClass = Exact::class;

    /**
     * Count validator store
     *
     * @var array
     */
    protected $_countValidators = [];

    /**
     * Arguments expected by this expectation
     *
     * @var array
     */
    protected $_expectedArgs = [];

    /**
     * Expected count of calls to this expectation
     *
     * @var int
     */
    protected $_expectedCount = -1;

    /**
     * Flag indicating whether the order of calling is determined locally or
     * globally
     *
     * @var bool
     */
    protected $_globally = false;

    /**
     * Integer representing the call order of this expectation on a global basis
     *
     * @var int
     */
    protected $_globalOrderNumber = null;

    /**
     * Mock object to which this expectation belongs
     *
     * @var LegacyMockInterface
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    protected $_mock = null;

    /**
     * Method name
     *
     * @var string
     */
    protected $_name = null;

    /**
<<<<<<< HEAD
     * Exception message
     *
     * @var string|null
     */
    protected $_because = null;

    /**
     * Arguments expected by this expectation
     *
     * @var array
     */
    protected $_expectedArgs = array();

    /**
     * Count validator store
     *
     * @var array
     */
    protected $_countValidators = array();

    /**
     * The count validator class to use
     *
     * @var string
     */
    protected $_countValidatorClass = 'Mockery\CountValidator\Exact';

    /**
     * Actual count of calls to this expectation
     *
     * @var int
     */
    protected $_actualCount = 0;

    /**
     * Value to return from this expectation
     *
     * @var mixed
     */
    protected $_returnValue = null;

    /**
     * Array of return values as a queue for multiple return sequence
     *
     * @var array
     */
    protected $_returnQueue = array();

    /**
     * Array of closures executed with given arguments to generate a result
     * to be returned
     *
     * @var array
     */
    protected $_closureQueue = array();

    /**
     * Array of values to be set when this expectation matches
     *
     * @var array
     */
    protected $_setQueue = array();

    /**
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Integer representing the call order of this expectation
     *
     * @var int
     */
    protected $_orderNumber = null;

    /**
<<<<<<< HEAD
     * Integer representing the call order of this expectation on a global basis
     *
     * @var int
     */
    protected $_globalOrderNumber = null;

    /**
     * Flag indicating that an exception is expected to be throw (not returned)
     *
     * @var bool
     */
    protected $_throw = false;

    /**
     * Flag indicating whether the order of calling is determined locally or
     * globally
     *
     * @var bool
     */
    protected $_globally = false;

    /**
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Flag indicating if the return value should be obtained from the original
     * class method instead of returning predefined values from the return queue
     *
     * @var bool
     */
    protected $_passthru = false;

    /**
<<<<<<< HEAD
     * Constructor
     *
     * @param \Mockery\LegacyMockInterface $mock
     * @param string $name
     */
    public function __construct(\Mockery\LegacyMockInterface $mock, $name)
=======
     * Array of return values as a queue for multiple return sequence
     *
     * @var array
     */
    protected $_returnQueue = [];

    /**
     * Value to return from this expectation
     *
     * @var mixed
     */
    protected $_returnValue = null;

    /**
     * Array of values to be set when this expectation matches
     *
     * @var array
     */
    protected $_setQueue = [];

    /**
     * Flag indicating that an exception is expected to be throw (not returned)
     *
     * @var bool
     */
    protected $_throw = false;

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct(LegacyMockInterface $mock, $name)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->_mock = $mock;
        $this->_name = $name;
        $this->withAnyArgs();
    }

    /**
<<<<<<< HEAD
     * Return a string with the method name and arguments formatted
     *
     * @param string $name Name of the expected method
     * @param array $args List of arguments to the method
=======
     * Cloning logic
     */
    public function __clone()
    {
        $newValidators = [];

        $countValidators = $this->_countValidators;

        foreach ($countValidators as $validator) {
            $newValidators[] = clone $validator;
        }

        $this->_countValidators = $newValidators;
    }

    /**
     * Return a string with the method name and arguments formatted
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return string
     */
    public function __toString()
    {
<<<<<<< HEAD
        return \Mockery::formatArgs($this->_name, $this->_expectedArgs);
    }

    /**
     * Verify the current call, i.e. that the given arguments match those
     * of this expectation
     *
     * @param array $args
     * @return mixed
     */
    public function verifyCall(array $args)
    {
        $this->validateOrder();
        $this->_actualCount++;
        if (true === $this->_passthru) {
            return $this->_mock->mockery_callSubjectMethod($this->_name, $args);
        }

        $return = $this->_getReturnValue($args);
        $this->throwAsNecessary($return);
        $this->_setValues();

        return $return;
    }

    /**
     * Throws an exception if the expectation has been configured to do so
     *
     * @throws \Exception|\Throwable
     * @return void
     */
    private function throwAsNecessary($return)
    {
        if (!$this->_throw) {
            return;
        }

        $type = \PHP_VERSION_ID >= 70000 ? "\Throwable" : "\Exception";

        if ($return instanceof $type) {
            throw $return;
        }

        return;
    }

    /**
     * Sets public properties with queued values to the mock object
     *
     * @param array $args
     * @return mixed
     */
    protected function _setValues()
    {
        $mockClass = get_class($this->_mock);
        $container = $this->_mock->mockery_getContainer();
        /** @var Mock[] $mocks */
        $mocks = $container->getMocks();
        foreach ($this->_setQueue as $name => &$values) {
            if (count($values) > 0) {
                $value = array_shift($values);
                $this->_mock->{$name} = $value;
                foreach ($mocks as $mock) {
                    if (is_a($mock, $mockClass) && $mock->mockery_isInstance()) {
                        $mock->{$name} = $value;
                    }
                }
            }
        }
    }

    /**
     * Fetch the return value for the matching args
     *
     * @param array $args
     * @return mixed
     */
    protected function _getReturnValue(array $args)
    {
        if (count($this->_closureQueue) > 1) {
            return call_user_func_array(array_shift($this->_closureQueue), $args);
        } elseif (count($this->_closureQueue) > 0) {
            return call_user_func_array(current($this->_closureQueue), $args);
        } elseif (count($this->_returnQueue) > 1) {
            return array_shift($this->_returnQueue);
        } elseif (count($this->_returnQueue) > 0) {
            return current($this->_returnQueue);
        }

        return $this->_mock->mockery_returnValueForMethod($this->_name);
    }

    /**
     * Checks if this expectation is eligible for additional calls
     *
     * @return bool
     */
    public function isEligible()
    {
        foreach ($this->_countValidators as $validator) {
            if (!$validator->isEligible($this->_actualCount)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if there is a constraint on call count
     *
     * @return bool
     */
    public function isCallCountConstrained()
    {
        return (count($this->_countValidators) > 0);
    }

    /**
     * Verify call order
     *
     * @return void
     */
    public function validateOrder()
    {
        if ($this->_orderNumber) {
            $this->_mock->mockery_validateOrder((string) $this, $this->_orderNumber, $this->_mock);
        }
        if ($this->_globalOrderNumber) {
            $this->_mock->mockery_getContainer()
                ->mockery_validateOrder((string) $this, $this->_globalOrderNumber, $this->_mock);
        }
    }

    /**
     * Verify this expectation
     *
     * @return void
     */
    public function verify()
    {
        foreach ($this->_countValidators as $validator) {
            $validator->validate($this->_actualCount);
        }
    }

    /**
     * Check if the registered expectation is an ArgumentListMatcher
     * @return bool
     */
    private function isArgumentListMatcher()
    {
        return (count($this->_expectedArgs) === 1 && ($this->_expectedArgs[0] instanceof ArgumentListMatcher));
    }

    private function isAndAnyOtherArgumentsMatcher($expectedArg)
    {
        return $expectedArg instanceof AndAnyOtherArgs;
    }

    /**
     * Check if passed arguments match an argument expectation
     *
     * @param array $args
     * @return bool
     */
    public function matchArgs(array $args)
    {
        if ($this->isArgumentListMatcher()) {
            return $this->_matchArg($this->_expectedArgs[0], $args);
        }
        $argCount = count($args);
        if ($argCount !== count((array) $this->_expectedArgs)) {
            $lastExpectedArgument = end($this->_expectedArgs);
            reset($this->_expectedArgs);

            if ($this->isAndAnyOtherArgumentsMatcher($lastExpectedArgument)) {
                $args = array_slice($args, 0, array_search($lastExpectedArgument, $this->_expectedArgs, true));
                return $this->_matchArgs($args);
            }

            return false;
        }

        return $this->_matchArgs($args);
    }

    /**
     * Check if the passed arguments match the expectations, one by one.
     *
     * @param array $args
     * @return bool
     */
    protected function _matchArgs($args)
    {
        $argCount = count($args);
        for ($i=0; $i<$argCount; $i++) {
            $param =& $args[$i];
            if (!$this->_matchArg($this->_expectedArgs[$i], $param)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check if passed argument matches an argument expectation
     *
     * @param mixed $expected
     * @param mixed $actual
     * @return bool
     */
    protected function _matchArg($expected, &$actual)
    {
        if ($expected === $actual) {
            return true;
        }
        if (!is_object($expected) && !is_object($actual) && $expected == $actual) {
            return true;
        }
        if (is_string($expected) && is_object($actual)) {
            $result = $actual instanceof $expected;
            if ($result) {
                return true;
            }
        }
        if ($expected instanceof \Mockery\Matcher\MatcherAbstract) {
            return $expected->match($actual);
        }
        if ($expected instanceof \Hamcrest\Matcher || $expected instanceof \Hamcrest_Matcher) {
            return $expected->matches($actual);
        }
        return false;
    }

    /**
     * Expected argument setter for the expectation
     *
     * @param mixed ...$args
     *
     * @return self
     */
    public function with(...$args)
    {
        return $this->withArgs($args);
    }

    /**
     * Expected arguments for the expectation passed as an array
     *
     * @param array $arguments
     * @return self
     */
    private function withArgsInArray(array $arguments)
    {
        if (empty($arguments)) {
            return $this->withNoArgs();
        }
        $this->_expectedArgs = $arguments;
        return $this;
    }

    /**
     * Expected arguments have to be matched by the given closure.
     *
     * @param Closure $closure
     * @return self
     */
    private function withArgsMatchedByClosure(Closure $closure)
    {
        $this->_expectedArgs = [new MultiArgumentClosure($closure)];
        return $this;
    }

    /**
     * Expected arguments for the expectation passed as an array or a closure that matches each passed argument on
     * each function call.
     *
     * @param array|Closure $argsOrClosure
     * @return self
     */
    public function withArgs($argsOrClosure)
    {
        if (is_array($argsOrClosure)) {
            $this->withArgsInArray($argsOrClosure);
        } elseif ($argsOrClosure instanceof Closure) {
            $this->withArgsMatchedByClosure($argsOrClosure);
        } else {
            throw new \InvalidArgumentException(sprintf('Call to %s with an invalid argument (%s), only array and ' .
                'closure are allowed', __METHOD__, $argsOrClosure));
        }
        return $this;
    }

    /**
     * Set with() as no arguments expected
     *
     * @return self
     */
    public function withNoArgs()
    {
        $this->_expectedArgs = [new NoArgs()];
        return $this;
    }

    /**
     * Set expectation that any arguments are acceptable
     *
     * @return self
     */
    public function withAnyArgs()
    {
        $this->_expectedArgs = [new AnyArgs()];
        return $this;
    }

    /**
     * Expected arguments should partially match the real arguments
     *
     * @param mixed ...$expectedArgs
     * @return self
     */
    public function withSomeOfArgs(...$expectedArgs)
    {
        return $this->withArgs(function (...$args) use ($expectedArgs) {
            foreach ($expectedArgs as $expectedArg) {
                if (!in_array($expectedArg, $args, true)) {
                    return false;
                }
            }
            return true;
        });
=======
        return Mockery::formatArgs($this->_name, $this->_expectedArgs);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Set a return value, or sequential queue of return values
     *
     * @param mixed ...$args
<<<<<<< HEAD
=======
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return self
     */
    public function andReturn(...$args)
    {
        $this->_returnQueue = $args;
<<<<<<< HEAD
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Set a return value, or sequential queue of return values
     *
     * @param mixed ...$args
=======
     * Sets up a closure to return the nth argument from the expected method call
     *
     * @param int $index
     *
     * @return self
     */
    public function andReturnArg($index)
    {
        if (! is_int($index) || $index < 0) {
            throw new InvalidArgumentException(
                'Invalid argument index supplied. Index must be a non-negative integer.'
            );
        }

        $closure = static function (...$args) use ($index) {
            if (array_key_exists($index, $args)) {
                return $args[$index];
            }

            throw new OutOfBoundsException(
                'Cannot return an argument value. No argument exists for the index ' . $index
            );
        };

        $this->_closureQueue = [$closure];

        return $this;
    }

    /**
     * @return self
     */
    public function andReturnFalse()
    {
        return $this->andReturn(false);
    }

    /**
     * Return null. This is merely a language construct for Mock describing.
     *
     * @return self
     */
    public function andReturnNull()
    {
        return $this->andReturn(null);
    }

    /**
     * Set a return value, or sequential queue of return values
     *
     * @param mixed ...$args
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return self
     */
    public function andReturns(...$args)
    {
<<<<<<< HEAD
        return call_user_func_array([$this, 'andReturn'], $args);
=======
        return $this->andReturn(...$args);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Return this mock, like a fluent interface
     *
     * @return self
     */
    public function andReturnSelf()
    {
        return $this->andReturn($this->_mock);
    }

    /**
<<<<<<< HEAD
     * Set a sequential queue of return values with an array
     *
     * @param array $values
     * @return self
     */
    public function andReturnValues(array $values)
    {
        call_user_func_array(array($this, 'andReturn'), $values);
        return $this;
    }

    /**
     * Set a closure or sequence of closures with which to generate return
     * values. The arguments passed to the expected method are passed to the
     * closures as parameters.
     *
     * @param callable ...$args
     * @return self
     */
    public function andReturnUsing(...$args)
    {
        $this->_closureQueue = $args;
        return $this;
    }

    /**
     * Sets up a closure to return the nth argument from the expected method call
     *
     * @param int $index
     * @return self
     */
    public function andReturnArg($index)
    {
        if (!is_int($index) || $index < 0) {
            throw new \InvalidArgumentException("Invalid argument index supplied. Index must be a positive integer.");
        }
        $closure = function (...$args) use ($index) {
            if (array_key_exists($index, $args)) {
                return $args[$index];
            }
            throw new \OutOfBoundsException("Cannot return an argument value. No argument exists for the index $index");
        };

        $this->_closureQueue = [$closure];
        return $this;
=======
     * @return self
     */
    public function andReturnTrue()
    {
        return $this->andReturn(true);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Return a self-returning black hole object.
     *
     * @return self
     */
    public function andReturnUndefined()
    {
<<<<<<< HEAD
        $this->andReturn(new \Mockery\Undefined());
=======
        return $this->andReturn(new Undefined());
    }

    /**
     * Set a closure or sequence of closures with which to generate return
     * values. The arguments passed to the expected method are passed to the
     * closures as parameters.
     *
     * @param callable ...$args
     *
     * @return self
     */
    public function andReturnUsing(...$args)
    {
        $this->_closureQueue = $args;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Return null. This is merely a language construct for Mock describing.
     *
     * @return self
     */
    public function andReturnNull()
    {
        return $this->andReturn(null);
    }

    public function andReturnFalse()
    {
        return $this->andReturn(false);
    }

    public function andReturnTrue()
    {
        return $this->andReturn(true);
    }

    /**
     * Set Exception class and arguments to that class to be thrown
     *
     * @param string|\Exception $exception
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     * @return self
     */
    public function andThrow($exception, $message = '', $code = 0, \Exception $previous = null)
    {
        $this->_throw = true;
        if (is_object($exception)) {
            $this->andReturn($exception);
        } else {
            $this->andReturn(new $exception($message, $code, $previous));
        }
        return $this;
    }

    public function andThrows($exception, $message = '', $code = 0, \Exception $previous = null)
    {
        return $this->andThrow($exception, $message, $code, $previous);
    }

    /**
     * Set Exception classes to be thrown
     *
     * @param array $exceptions
     * @return self
     */
    public function andThrowExceptions(array $exceptions)
    {
        $this->_throw = true;
        foreach ($exceptions as $exception) {
            if (!is_object($exception)) {
                throw new Exception('You must pass an array of exception objects to andThrowExceptions');
            }
        }
        return $this->andReturnValues($exceptions);
=======
     * Set a sequential queue of return values with an array
     *
     * @return self
     */
    public function andReturnValues(array $values)
    {
        return $this->andReturn(...$values);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Register values to be set to a public property each time this expectation occurs
     *
     * @param string $name
<<<<<<< HEAD
     * @param array ...$values
=======
     * @param array  ...$values
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return self
     */
    public function andSet($name, ...$values)
    {
        $this->_setQueue[$name] = $values;
<<<<<<< HEAD
=======

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Alias to andSet(). Allows the natural English construct
     * - set('foo', 'bar')->andReturn('bar')
     *
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function set($name, $value)
    {
        return call_user_func_array(array($this, 'andSet'), func_get_args());
    }

    /**
     * Indicates this expectation should occur zero or more times
     *
     * @return self
     */
    public function zeroOrMoreTimes()
    {
        $this->atLeast()->never();
    }

    /**
     * Indicates the number of times this expectation should occur
     *
     * @param int $limit
     * @throws \InvalidArgumentException
     * @return self
     */
    public function times($limit = null)
    {
        if (is_null($limit)) {
            return $this;
        }
        if (!is_int($limit)) {
            throw new \InvalidArgumentException('The passed Times limit should be an integer value');
        }
        $this->_countValidators[$this->_countValidatorClass] = new $this->_countValidatorClass($this, $limit);
        $this->_countValidatorClass = 'Mockery\CountValidator\Exact';
=======
     * Set Exception class and arguments to that class to be thrown
     *
     * @param string|Throwable $exception
     * @param string           $message
     * @param int              $code
     *
     * @return self
     */
    public function andThrow($exception, $message = '', $code = 0, ?\Exception $previous = null)
    {
        $this->_throw = true;

        if (is_object($exception)) {
            return $this->andReturn($exception);
        }

        return $this->andReturn(new $exception($message, $code, $previous));
    }

    /**
     * Set Exception classes to be thrown
     *
     * @return self
     */
    public function andThrowExceptions(array $exceptions)
    {
        $this->_throw = true;

        foreach ($exceptions as $exception) {
            if (! is_object($exception)) {
                throw new Exception('You must pass an array of exception objects to andThrowExceptions');
            }
        }

        return $this->andReturnValues($exceptions);
    }

    public function andThrows($exception, $message = '', $code = 0, ?\Exception $previous = null)
    {
        return $this->andThrow($exception, $message, $code, $previous);
    }

    /**
     * Sets up a closure that will yield each of the provided args
     *
     * @param mixed ...$args
     *
     * @return self
     */
    public function andYield(...$args)
    {
        $closure = static function () use ($args) {
            foreach ($args as $arg) {
                yield $arg;
            }
        };

        $this->_closureQueue = [$closure];

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
=======
     * Sets next count validator to the AtLeast instance
     *
     * @return self
     */
    public function atLeast()
    {
        $this->_countValidatorClass = AtLeast::class;

        return $this;
    }

    /**
     * Sets next count validator to the AtMost instance
     *
     * @return self
     */
    public function atMost()
    {
        $this->_countValidatorClass = AtMost::class;

        return $this;
    }

    /**
     * Set the exception message
     *
     * @param string $message
     *
     * @return $this
     */
    public function because($message)
    {
        $this->_because = $message;

        return $this;
    }

    /**
     * Shorthand for setting minimum and maximum constraints on call counts
     *
     * @param int $minimum
     * @param int $maximum
     */
    public function between($minimum, $maximum)
    {
        return $this->atLeast()->times($minimum)->atMost()->times($maximum);
    }

    /**
     * Mark this expectation as being a default
     *
     * @return self
     */
    public function byDefault()
    {
        $director = $this->_mock->mockery_getExpectationsFor($this->_name);

        if ($director instanceof ExpectationDirector) {
            $director->makeExpectationDefault($this);
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getExceptionMessage()
    {
        return $this->_because;
    }

    /**
     * Return the parent mock of the expectation
     *
     * @return LegacyMockInterface|MockInterface
     */
    public function getMock()
    {
        return $this->_mock;
    }

    public function getName()
    {
        return $this->_name;
    }

    /**
     * Return order number
     *
     * @return int
     */
    public function getOrderNumber()
    {
        return $this->_orderNumber;
    }

    /**
     * Indicates call order should apply globally
     *
     * @return self
     */
    public function globally()
    {
        $this->_globally = true;

        return $this;
    }

    /**
     * Check if there is a constraint on call count
     *
     * @return bool
     */
    public function isCallCountConstrained()
    {
        return $this->_countValidators !== [];
    }

    /**
     * Checks if this expectation is eligible for additional calls
     *
     * @return bool
     */
    public function isEligible()
    {
        foreach ($this->_countValidators as $validator) {
            if (! $validator->isEligible($this->_actualCount)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Check if passed arguments match an argument expectation
     *
     * @return bool
     */
    public function matchArgs(array $args)
    {
        if ($this->isArgumentListMatcher()) {
            return $this->_matchArg($this->_expectedArgs[0], $args);
        }

        $argCount = count($args);

        $expectedArgsCount = count($this->_expectedArgs);

        if ($argCount === $expectedArgsCount) {
            return $this->_matchArgs($args);
        }

        $lastExpectedArgument = $this->_expectedArgs[$expectedArgsCount - 1];

        if ($lastExpectedArgument instanceof AndAnyOtherArgs) {
            $firstCorrespondingKey = array_search($lastExpectedArgument, $this->_expectedArgs, true);

            $args = array_slice($args, 0, $firstCorrespondingKey);

            return $this->_matchArgs($args);
        }

        return false;
    }

    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Indicates that this expectation is never expected to be called
     *
     * @return self
     */
    public function never()
    {
        return $this->times(0);
    }

    /**
     * Indicates that this expectation is expected exactly once
     *
     * @return self
     */
    public function once()
    {
        return $this->times(1);
    }

    /**
<<<<<<< HEAD
=======
     * Indicates that this expectation must be called in a specific given order
     *
     * @param string $group Name of the ordered group
     *
     * @return self
     */
    public function ordered($group = null)
    {
        if ($this->_globally) {
            $this->_globalOrderNumber = $this->_defineOrdered($group, $this->_mock->mockery_getContainer());
        } else {
            $this->_orderNumber = $this->_defineOrdered($group, $this->_mock);
        }

        $this->_globally = false;

        return $this;
    }

    /**
     * Flag this expectation as calling the original class method with
     * the provided arguments instead of using a return value queue.
     *
     * @return self
     */
    public function passthru()
    {
        if ($this->_mock instanceof Mock) {
            throw new Exception(
                'Mock Objects not created from a loaded/existing class are incapable of passing method calls through to a parent class'
            );
        }

        $this->_passthru = true;

        return $this;
    }

    /**
     * Alias to andSet(). Allows the natural English construct
     * - set('foo', 'bar')->andReturn('bar')
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return self
     */
    public function set($name, $value)
    {
        return $this->andSet(...func_get_args());
    }

    /**
     * Indicates the number of times this expectation should occur
     *
     * @param int $limit
     *
     * @throws InvalidArgumentException
     *
     * @return self
     */
    public function times($limit = null)
    {
        if ($limit === null) {
            return $this;
        }

        if (! is_int($limit)) {
            throw new InvalidArgumentException('The passed Times limit should be an integer value');
        }

        if ($this->_expectedCount === 0) {
            @trigger_error(self::ERROR_ZERO_INVOCATION, E_USER_DEPRECATED);
            // throw new \InvalidArgumentException(self::ERROR_ZERO_INVOCATION);
        }

        if ($limit === 0) {
            $this->_countValidators = [];
        }

        $this->_expectedCount = $limit;

        $this->_countValidators[$this->_countValidatorClass] = new $this->_countValidatorClass($this, $limit);

        if ($this->_countValidatorClass !== Exact::class) {
            $this->_countValidatorClass = Exact::class;

            unset($this->_countValidators[$this->_countValidatorClass]);
        }

        return $this;
    }

    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Indicates that this expectation is expected exactly twice
     *
     * @return self
     */
    public function twice()
    {
        return $this->times(2);
    }

    /**
<<<<<<< HEAD
     * Sets next count validator to the AtLeast instance
     *
     * @return self
     */
    public function atLeast()
    {
        $this->_countValidatorClass = 'Mockery\CountValidator\AtLeast';
        return $this;
    }

    /**
     * Sets next count validator to the AtMost instance
     *
     * @return self
     */
    public function atMost()
    {
        $this->_countValidatorClass = 'Mockery\CountValidator\AtMost';
        return $this;
    }

    /**
     * Shorthand for setting minimum and maximum constraints on call counts
     *
     * @param int $minimum
     * @param int $maximum
     */
    public function between($minimum, $maximum)
    {
        return $this->atLeast()->times($minimum)->atMost()->times($maximum);
    }


    /**
     * Set the exception message
     *
     * @param string $message
     * @return $this
     */
    public function because($message)
    {
        $this->_because = $message;
        return $this;
    }

    /**
     * Indicates that this expectation must be called in a specific given order
     *
     * @param string $group Name of the ordered group
     * @return self
     */
    public function ordered($group = null)
    {
        if ($this->_globally) {
            $this->_globalOrderNumber = $this->_defineOrdered($group, $this->_mock->mockery_getContainer());
        } else {
            $this->_orderNumber = $this->_defineOrdered($group, $this->_mock);
        }
        $this->_globally = false;
=======
     * Verify call order
     *
     * @return void
     */
    public function validateOrder()
    {
        if ($this->_orderNumber) {
            $this->_mock->mockery_validateOrder((string) $this, $this->_orderNumber, $this->_mock);
        }

        if ($this->_globalOrderNumber) {
            $this->_mock->mockery_getContainer()->mockery_validateOrder(
                (string) $this,
                $this->_globalOrderNumber,
                $this->_mock
            );
        }
    }

    /**
     * Verify this expectation
     *
     * @return void
     */
    public function verify()
    {
        foreach ($this->_countValidators as $validator) {
            $validator->validate($this->_actualCount);
        }
    }

    /**
     * Verify the current call, i.e. that the given arguments match those
     * of this expectation
     *
     * @throws Throwable
     *
     * @return mixed
     */
    public function verifyCall(array $args)
    {
        $this->validateOrder();

        ++$this->_actualCount;

        if ($this->_passthru === true) {
            return $this->_mock->mockery_callSubjectMethod($this->_name, $args);
        }

        $return = $this->_getReturnValue($args);

        $this->throwAsNecessary($return);

        $this->_setValues();

        return $return;
    }

    /**
     * Expected argument setter for the expectation
     *
     * @param mixed ...$args
     *
     * @return self
     */
    public function with(...$args)
    {
        return $this->withArgs($args);
    }

    /**
     * Set expectation that any arguments are acceptable
     *
     * @return self
     */
    public function withAnyArgs()
    {
        $this->_expectedArgs = [new AnyArgs()];

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Indicates call order should apply globally
     *
     * @return self
     */
    public function globally()
    {
        $this->_globally = true;
=======
     * Expected arguments for the expectation passed as an array or a closure that matches each passed argument on
     * each function call.
     *
     * @param array|Closure $argsOrClosure
     *
     * @return self
     */
    public function withArgs($argsOrClosure)
    {
        if (is_array($argsOrClosure)) {
            return $this->withArgsInArray($argsOrClosure);
        }

        if ($argsOrClosure instanceof Closure) {
            return $this->withArgsMatchedByClosure($argsOrClosure);
        }

        throw new InvalidArgumentException(sprintf(
            'Call to %s with an invalid argument (%s), only array and closure are allowed',
            __METHOD__,
            $argsOrClosure
        ));
    }

    /**
     * Set with() as no arguments expected
     *
     * @return self
     */
    public function withNoArgs()
    {
        $this->_expectedArgs = [new NoArgs()];

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
=======
     * Expected arguments should partially match the real arguments
     *
     * @param mixed ...$expectedArgs
     *
     * @return self
     */
    public function withSomeOfArgs(...$expectedArgs)
    {
        return $this->withArgs(static function (...$args) use ($expectedArgs): bool {
            foreach ($expectedArgs as $expectedArg) {
                if (! in_array($expectedArg, $args, true)) {
                    return false;
                }
            }

            return true;
        });
    }

    /**
     * Indicates this expectation should occur zero or more times
     *
     * @return self
     */
    public function zeroOrMoreTimes()
    {
        return $this->atLeast()->never();
    }

    /**
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * Setup the ordering tracking on the mock or mock container
     *
     * @param string $group
     * @param object $ordering
<<<<<<< HEAD
=======
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return int
     */
    protected function _defineOrdered($group, $ordering)
    {
        $groups = $ordering->mockery_getGroups();
<<<<<<< HEAD
        if (is_null($group)) {
            $result = $ordering->mockery_allocateOrder();
        } elseif (isset($groups[$group])) {
            $result = $groups[$group];
        } else {
            $result = $ordering->mockery_allocateOrder();
            $ordering->mockery_setGroup($group, $result);
        }
=======
        if ($group === null) {
            return $ordering->mockery_allocateOrder();
        }

        if (array_key_exists($group, $groups)) {
            return $groups[$group];
        }

        $result = $ordering->mockery_allocateOrder();

        $ordering->mockery_setGroup($group, $result);

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $result;
    }

    /**
<<<<<<< HEAD
     * Return order number
     *
     * @return int
     */
    public function getOrderNumber()
    {
        return $this->_orderNumber;
    }

    /**
     * Mark this expectation as being a default
     *
     * @return self
     */
    public function byDefault()
    {
        $director = $this->_mock->mockery_getExpectationsFor($this->_name);
        if (!empty($director)) {
            $director->makeExpectationDefault($this);
        }
=======
     * Fetch the return value for the matching args
     *
     * @return mixed
     */
    protected function _getReturnValue(array $args)
    {
        $closureQueueCount = count($this->_closureQueue);

        if ($closureQueueCount > 1) {
            return array_shift($this->_closureQueue)(...$args);
        }

        if ($closureQueueCount > 0) {
            return current($this->_closureQueue)(...$args);
        }

        $returnQueueCount = count($this->_returnQueue);

        if ($returnQueueCount > 1) {
            return array_shift($this->_returnQueue);
        }

        if ($returnQueueCount > 0) {
            return current($this->_returnQueue);
        }

        return $this->_mock->mockery_returnValueForMethod($this->_name);
    }

    /**
     * Check if passed argument matches an argument expectation
     *
     * @param mixed $expected
     * @param mixed $actual
     *
     * @return bool
     */
    protected function _matchArg($expected, &$actual)
    {
        if ($expected === $actual) {
            return true;
        }

        if ($expected instanceof MatcherInterface) {
            return $expected->match($actual);
        }

        if ($expected instanceof Constraint) {
            return (bool) $expected->evaluate($actual, '', true);
        }

        if ($expected instanceof Matcher || $expected instanceof Hamcrest_Matcher) {
            @trigger_error('Hamcrest package has been deprecated and will be removed in 2.0', E_USER_DEPRECATED);

            return $expected->matches($actual);
        }

        if (is_object($expected)) {
            $matcher = Mockery::getConfiguration()->getDefaultMatcher(get_class($expected));

            return $matcher === null ? false : $this->_matchArg(new $matcher($expected), $actual);
        }

        if (is_object($actual) && is_string($expected) && $actual instanceof $expected) {
            return true;
        }

        return $expected == $actual;
    }

    /**
     * Check if the passed arguments match the expectations, one by one.
     *
     * @param array $args
     *
     * @return bool
     */
    protected function _matchArgs($args)
    {
        for ($index = 0, $argCount = count($args); $index < $argCount; ++$index) {
            $param = &$args[$index];

            if (! $this->_matchArg($this->_expectedArgs[$index], $param)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Sets public properties with queued values to the mock object
     *
     * @return void
     */
    protected function _setValues()
    {
        $mockClass = get_class($this->_mock);

        $container = $this->_mock->mockery_getContainer();

        $mocks = $container->getMocks();

        foreach ($this->_setQueue as $name => &$values) {
            if ($values === []) {
                continue;
            }

            $value = array_shift($values);

            $this->_mock->{$name} = $value;

            foreach ($mocks as $mock) {
                if (! $mock instanceof $mockClass) {
                    continue;
                }

                if (! $mock->mockery_isInstance()) {
                    continue;
                }

                $mock->{$name} = $value;
            }
        }
    }

    /**
     * @template TExpectedArg
     *
     * @param TExpectedArg $expectedArg
     *
     * @return bool
     */
    private function isAndAnyOtherArgumentsMatcher($expectedArg)
    {
        return $expectedArg instanceof AndAnyOtherArgs;
    }

    /**
     * Check if the registered expectation is an ArgumentListMatcher
     *
     * @return bool
     */
    private function isArgumentListMatcher()
    {
        return $this->_expectedArgs !== [] && $this->_expectedArgs[0] instanceof ArgumentListMatcher;
    }

    /**
     * Throws an exception if the expectation has been configured to do so
     *
     * @param Throwable $return
     *
     * @throws Throwable
     *
     * @return void
     */
    private function throwAsNecessary($return)
    {
        if (! $this->_throw) {
            return;
        }

        if (! $return instanceof Throwable) {
            return;
        }

        throw $return;
    }

    /**
     * Expected arguments for the expectation passed as an array
     *
     * @return self
     */
    private function withArgsInArray(array $arguments)
    {
        if ($arguments === []) {
            return $this->withNoArgs();
        }

        $this->_expectedArgs = $arguments;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        return $this;
    }

    /**
<<<<<<< HEAD
     * Return the parent mock of the expectation
     *
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
    public function getMock()
    {
        return $this->_mock;
    }

    /**
     * Flag this expectation as calling the original class method with the
     * any provided arguments instead of using a return value queue.
     *
     * @return self
     */
    public function passthru()
    {
        if ($this->_mock instanceof Mock) {
            throw new Exception(
                'Mock Objects not created from a loaded/existing class are '
                . 'incapable of passing method calls through to a parent class'
            );
        }
        $this->_passthru = true;
        return $this;
    }

    /**
     * Cloning logic
     *
     */
    public function __clone()
    {
        $newValidators = array();
        $countValidators = $this->_countValidators;
        foreach ($countValidators as $validator) {
            $newValidators[] = clone $validator;
        }
        $this->_countValidators = $newValidators;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getExceptionMessage()
    {
        return $this->_because;
    }
=======
     * Expected arguments have to be matched by the given closure.
     *
     * @return self
     */
    private function withArgsMatchedByClosure(Closure $closure)
    {
        $this->_expectedArgs = [new MultiArgumentClosure($closure)];

        return $this;
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
