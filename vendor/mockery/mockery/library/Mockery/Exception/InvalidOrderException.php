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

namespace Mockery\Exception;

<<<<<<< HEAD
use Mockery;

class InvalidOrderException extends Mockery\Exception
{
    protected $method = null;

    protected $expected = 0;

    protected $actual = null;

    protected $mockObject = null;

    public function setMock(Mockery\LegacyMockInterface $mock)
    {
        $this->mockObject = $mock;
        return $this;
    }

    public function setMethodName($name)
    {
        $this->method = $name;
        return $this;
    }

=======
use Mockery\Exception;
use Mockery\LegacyMockInterface;

class InvalidOrderException extends Exception
{
    /**
     * @var int|null
     */
    protected $actual = null;

    /**
     * @var int
     */
    protected $expected = 0;

    /**
     * @var string|null
     */
    protected $method = null;

    /**
     * @var LegacyMockInterface|null
     */
    protected $mockObject = null;

    /**
     * @return int|null
     */
    public function getActualOrder()
    {
        return $this->actual;
    }

    /**
     * @return int
     */
    public function getExpectedOrder()
    {
        return $this->expected;
    }

    /**
     * @return string|null
     */
    public function getMethodName()
    {
        return $this->method;
    }

    /**
     * @return LegacyMockInterface|null
     */
    public function getMock()
    {
        return $this->mockObject;
    }

    /**
     * @return string|null
     */
    public function getMockName()
    {
        $mock = $this->getMock();

        if ($mock === null) {
            return $mock;
        }

        return $mock->mockery_getName();
    }

    /**
     * @param int $count
     *
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function setActualOrder($count)
    {
        $this->actual = $count;
        return $this;
    }

<<<<<<< HEAD
=======
    /**
     * @param int $count
     *
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function setExpectedOrder($count)
    {
        $this->expected = $count;
        return $this;
    }

<<<<<<< HEAD
    public function getMock()
    {
        return $this->mockObject;
    }

    public function getMethodName()
    {
        return $this->method;
    }

    public function getActualOrder()
    {
        return $this->actual;
    }

    public function getExpectedOrder()
    {
        return $this->expected;
    }

    public function getMockName()
    {
        return $this->getMock()->mockery_getName();
=======
    /**
     * @param string $name
     *
     * @return self
     */
    public function setMethodName($name)
    {
        $this->method = $name;
        return $this;
    }

    /**
     * @return self
     */
    public function setMock(LegacyMockInterface $mock)
    {
        $this->mockObject = $mock;
        return $this;
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    }
}
