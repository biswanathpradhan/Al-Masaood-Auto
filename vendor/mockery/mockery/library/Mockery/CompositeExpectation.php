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

<<<<<<< HEAD
=======
use function array_map;
use function current;
use function implode;
use function reset;

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
class CompositeExpectation implements ExpectationInterface
{
    /**
     * Stores an array of all expectations for this composite
     *
<<<<<<< HEAD
     * @var array
     */
    protected $_expectations = array();
=======
     * @var array<ExpectationInterface>
     */
    protected $_expectations = [];

    /**
     * Intercept any expectation calls and direct against all expectations
     *
     * @param string $method
     *
     * @return self
     */
    public function __call($method, array $args)
    {
        foreach ($this->_expectations as $expectation) {
            $expectation->{$method}(...$args);
        }

        return $this;
    }

    /**
     * Return the string summary of this composite expectation
     *
     * @return string
     */
    public function __toString()
    {
        $parts = array_map(static function (ExpectationInterface $expectation): string {
            return (string) $expectation;
        }, $this->_expectations);

        return '[' . implode(', ', $parts) . ']';
    }
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Add an expectation to the composite
     *
<<<<<<< HEAD
     * @param \Mockery\Expectation|\Mockery\CompositeExpectation $expectation
=======
     * @param ExpectationInterface|HigherOrderMessage $expectation
     *
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return void
     */
    public function add($expectation)
    {
        $this->_expectations[] = $expectation;
    }

    /**
     * @param mixed ...$args
     */
    public function andReturn(...$args)
    {
        return $this->__call(__FUNCTION__, $args);
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
    public function andReturns(...$args)
    {
<<<<<<< HEAD
        return call_user_func_array([$this, 'andReturn'], $args);
    }

    /**
     * Intercept any expectation calls and direct against all expectations
     *
     * @param string $method
     * @param array $args
     * @return self
     */
    public function __call($method, array $args)
    {
        foreach ($this->_expectations as $expectation) {
            call_user_func_array(array($expectation, $method), $args);
        }
        return $this;
=======
        return $this->andReturn(...$args);
    }

    /**
     * Return the parent mock of the first expectation
     *
     * @return LegacyMockInterface&MockInterface
     */
    public function getMock()
    {
        reset($this->_expectations);
        $first = current($this->_expectations);
        return $first->getMock();
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Return order number of the first expectation
     *
     * @return int
     */
    public function getOrderNumber()
    {
        reset($this->_expectations);
        $first = current($this->_expectations);
        return $first->getOrderNumber();
    }

    /**
<<<<<<< HEAD
     * Return the parent mock of the first expectation
     *
     * @return \Mockery\MockInterface|\Mockery\LegacyMockInterface
     */
    public function getMock()
    {
        reset($this->_expectations);
        $first = current($this->_expectations);
        return $first->getMock();
    }

    /**
     * Mockery API alias to getMock
     *
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface
=======
     * Mockery API alias to getMock
     *
     * @return LegacyMockInterface&MockInterface
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function mock()
    {
        return $this->getMock();
    }

    /**
<<<<<<< HEAD
     * Starts a new expectation addition on the first mock which is the primary
     * target outside of a demeter chain
     *
     * @param mixed ...$args
     * @return \Mockery\Expectation
     */
    public function shouldReceive(...$args)
    {
        reset($this->_expectations);
        $first = current($this->_expectations);
        return call_user_func_array(array($first->getMock(), 'shouldReceive'), $args);
    }

    /**
     * Starts a new expectation addition on the first mock which is the primary
     * target outside of a demeter chain
     *
     * @param mixed ...$args
     * @return \Mockery\Expectation
=======
     * Starts a new expectation addition on the first mock which is the primary target outside of a demeter chain
     *
     * @param mixed ...$args
     *
     * @return Expectation
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function shouldNotReceive(...$args)
    {
        reset($this->_expectations);
        $first = current($this->_expectations);
<<<<<<< HEAD
        return call_user_func_array(array($first->getMock(), 'shouldNotReceive'), $args);
    }

    /**
     * Return the string summary of this composite expectation
     *
     * @return string
     */
    public function __toString()
    {
        $return = '[';
        $parts = array();
        foreach ($this->_expectations as $exp) {
            $parts[] = (string) $exp;
        }
        $return .= implode(', ', $parts) . ']';
        return $return;
=======
        return $first->getMock()->shouldNotReceive(...$args);
    }

    /**
     * Starts a new expectation addition on the first mock which is the primary target, outside of a demeter chain
     *
     * @param mixed ...$args
     *
     * @return Expectation
     */
    public function shouldReceive(...$args)
    {
        reset($this->_expectations);
        $first = current($this->_expectations);
        return $first->getMock()->shouldReceive(...$args);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
