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
class ExpectationDirector
{
    /**
     * Method name the director is directing
     *
     * @var string
     */
    protected $_name = null;

    /**
     * Mock object the director is attached to
     *
     * @var \Mockery\MockInterface|\Mockery\LegacyMockInterface
     */
    protected $_mock = null;
=======
use Mockery;
use Mockery\Exception\NoMatchingExpectationException;

use function array_pop;
use function array_unshift;
use function end;

use const PHP_EOL;

class ExpectationDirector
{
    /**
     * Stores an array of all default expectations for this mock
     *
     * @var list<ExpectationInterface>
     */
    protected $_defaults = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Stores an array of all expectations for this mock
     *
<<<<<<< HEAD
     * @var array
     */
    protected $_expectations = array();
=======
     * @var list<ExpectationInterface>
     */
    protected $_expectations = [];
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * The expected order of next call
     *
     * @var int
     */
    protected $_expectedOrder = null;

    /**
<<<<<<< HEAD
     * Stores an array of all default expectations for this mock
     *
     * @var array
     */
    protected $_defaults = array();
=======
     * Mock object the director is attached to
     *
     * @var LegacyMockInterface|MockInterface
     */
    protected $_mock = null;

    /**
     * Method name the director is directing
     *
     * @var string
     */
    protected $_name = null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1

    /**
     * Constructor
     *
     * @param string $name
<<<<<<< HEAD
     * @param \Mockery\LegacyMockInterface $mock
     */
    public function __construct($name, \Mockery\LegacyMockInterface $mock)
=======
     */
    public function __construct($name, LegacyMockInterface $mock)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->_name = $name;
        $this->_mock = $mock;
    }

    /**
     * Add a new expectation to the director
<<<<<<< HEAD
     *
     * @param \Mockery\Expectation $expectation
     */
    public function addExpectation(\Mockery\Expectation $expectation)
=======
     */
    public function addExpectation(Expectation $expectation)
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    {
        $this->_expectations[] = $expectation;
    }

    /**
     * Handle a method call being directed by this instance
     *
<<<<<<< HEAD
     * @param array $args
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return mixed
     */
    public function call(array $args)
    {
        $expectation = $this->findExpectation($args);
<<<<<<< HEAD
        if (is_null($expectation)) {
            $exception = new \Mockery\Exception\NoMatchingExpectationException(
                'No matching handler found for '
                . $this->_mock->mockery_getName() . '::'
                . \Mockery::formatArgs($this->_name, $args)
                . '. Either the method was unexpected or its arguments matched'
                . ' no expected argument list for this method'
                . PHP_EOL . PHP_EOL
                . \Mockery::formatObjects($args)
            );
            $exception->setMock($this->_mock)
                ->setMethodName($this->_name)
                ->setActualArguments($args);
            throw $exception;
        }
        return $expectation->verifyCall($args);
    }

    /**
     * Verify all expectations of the director
     *
     * @throws \Mockery\CountValidator\Exception
     * @return void
     */
    public function verify()
    {
        if (!empty($this->_expectations)) {
            foreach ($this->_expectations as $exp) {
                $exp->verify();
            }
        } else {
            foreach ($this->_defaults as $exp) {
                $exp->verify();
            }
        }
=======
        if ($expectation !== null) {
            return $expectation->verifyCall($args);
        }

        $exception = new NoMatchingExpectationException(
            'No matching handler found for '
            . $this->_mock->mockery_getName() . '::'
            . Mockery::formatArgs($this->_name, $args)
            . '. Either the method was unexpected or its arguments matched'
            . ' no expected argument list for this method'
            . PHP_EOL . PHP_EOL
            . Mockery::formatObjects($args)
        );

        $exception->setMock($this->_mock)
            ->setMethodName($this->_name)
            ->setActualArguments($args);

        throw $exception;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }

    /**
     * Attempt to locate an expectation matching the provided args
     *
<<<<<<< HEAD
     * @param array $args
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     * @return mixed
     */
    public function findExpectation(array $args)
    {
        $expectation = null;

<<<<<<< HEAD
        if (!empty($this->_expectations)) {
            $expectation = $this->_findExpectationIn($this->_expectations, $args);
        }

        if ($expectation === null && !empty($this->_defaults)) {
            $expectation = $this->_findExpectationIn($this->_defaults, $args);
=======
        if ($this->_expectations !== []) {
            $expectation = $this->_findExpectationIn($this->_expectations, $args);
        }

        if ($expectation === null && $this->_defaults !== []) {
            return $this->_findExpectationIn($this->_defaults, $args);
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        }

        return $expectation;
    }

    /**
<<<<<<< HEAD
     * Make the given expectation a default for all others assuming it was
     * correctly created last
     *
     * @param \Mockery\Expectation $expectation
     */
    public function makeExpectationDefault(\Mockery\Expectation $expectation)
    {
        $last = end($this->_expectations);
        if ($last === $expectation) {
            array_pop($this->_expectations);
            array_unshift($this->_defaults, $expectation);
        } else {
            throw new \Mockery\Exception(
                'Cannot turn a previously defined expectation into a default'
            );
        }
    }

    /**
     * Search current array of expectations for a match
     *
     * @param array $expectations
     * @param array $args
     * @return mixed
     */
    protected function _findExpectationIn(array $expectations, array $args)
    {
        foreach ($expectations as $exp) {
            if ($exp->isEligible() && $exp->matchArgs($args)) {
                return $exp;
            }
        }
        foreach ($expectations as $exp) {
            if ($exp->matchArgs($args)) {
                return $exp;
            }
        }
    }

    /**
     * Return all expectations assigned to this director
     *
     * @return array
     */
    public function getExpectations()
    {
        return $this->_expectations;
    }

    /**
     * Return all expectations assigned to this director
     *
     * @return array
=======
     * Return all expectations assigned to this director
     *
     * @return array<ExpectationInterface>
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function getDefaultExpectations()
    {
        return $this->_defaults;
    }

    /**
     * Return the number of expectations assigned to this director.
     *
     * @return int
     */
    public function getExpectationCount()
    {
<<<<<<< HEAD
        return count($this->getExpectations()) ?: count($this->getDefaultExpectations());
=======
        $count = 0;

        $expectations = $this->getExpectations();

        if ($expectations === []) {
            $expectations = $this->getDefaultExpectations();
        }

        foreach ($expectations as $expectation) {
            if ($expectation->isCallCountConstrained()) {
                ++$count;
            }
        }

        return $count;
    }

    /**
     * Return all expectations assigned to this director
     *
     * @return array<ExpectationInterface>
     */
    public function getExpectations()
    {
        return $this->_expectations;
    }

    /**
     * Make the given expectation a default for all others assuming it was correctly created last
     *
     * @throws Exception
     *
     * @return void
     */
    public function makeExpectationDefault(Expectation $expectation)
    {
        if (end($this->_expectations) === $expectation) {
            array_pop($this->_expectations);

            array_unshift($this->_defaults, $expectation);

            return;
        }

        throw new Exception('Cannot turn a previously defined expectation into a default');
    }

    /**
     * Verify all expectations of the director
     *
     * @throws Exception
     *
     * @return void
     */
    public function verify()
    {
        if ($this->_expectations !== []) {
            foreach ($this->_expectations as $expectation) {
                $expectation->verify();
            }

            return;
        }

        foreach ($this->_defaults as $expectation) {
            $expectation->verify();
        }
    }

    /**
     * Search current array of expectations for a match
     *
     * @param array<ExpectationInterface> $expectations
     *
     * @return null|ExpectationInterface
     */
    protected function _findExpectationIn(array $expectations, array $args)
    {
        foreach ($expectations as $expectation) {
            if (! $expectation->isEligible()) {
                continue;
            }

            if (! $expectation->matchArgs($args)) {
                continue;
            }

            return $expectation;
        }

        foreach ($expectations as $expectation) {
            if ($expectation->matchArgs($args)) {
                return $expectation;
            }
        }

        return null;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
