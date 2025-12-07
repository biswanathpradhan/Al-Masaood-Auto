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
use Mockery\Exception\RuntimeException;

class InvalidCountException extends Mockery\CountValidator\Exception
{
    protected $method = null;

    protected $expected = 0;

    protected $expectedComparative = '<=';

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
use Mockery\CountValidator\Exception;
use Mockery\LegacyMockInterface;

use function in_array;

class InvalidCountException extends Exception
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
     * @var string
     */
    protected $expectedComparative = '<=';

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
    public function getActualCount()
    {
        return $this->actual;
    }

    /**
     * @return int
     */
    public function getExpectedCount()
    {
        return $this->expected;
    }

    /**
     * @return string
     */
    public function getExpectedCountComparative()
    {
        return $this->expectedComparative;
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
     * @throws RuntimeException
     * @return string|null
     */
    public function getMockName()
    {
        $mock = $this->getMock();

        if ($mock === null) {
            return '';
        }

        return $mock->mockery_getName();
    }

    /**
     * @param  int  $count
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function setActualCount($count)
    {
        $this->actual = $count;
        return $this;
    }

<<<<<<< HEAD
=======
    /**
     * @param  int  $count
     * @return self
     */
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
    public function setExpectedCount($count)
    {
        $this->expected = $count;
        return $this;
    }

<<<<<<< HEAD
    public function setExpectedCountComparative($comp)
    {
        if (!in_array($comp, array('=', '>', '<', '>=', '<='))) {
            throw new RuntimeException(
                'Illegal comparative for expected call counts set: ' . $comp
            );
        }
=======
    /**
     * @param  string $comp
     * @return self
     */
    public function setExpectedCountComparative($comp)
    {
        if (! in_array($comp, ['=', '>', '<', '>=', '<='], true)) {
            throw new RuntimeException('Illegal comparative for expected call counts set: ' . $comp);
        }

>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
        $this->expectedComparative = $comp;
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

    public function getActualCount()
    {
        return $this->actual;
    }

    public function getExpectedCount()
    {
        return $this->expected;
    }

    public function getMockName()
    {
        return $this->getMock()->mockery_getName();
    }

    public function getExpectedCountComparative()
    {
        return $this->expectedComparative;
=======
    /**
     * @param  string $name
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
