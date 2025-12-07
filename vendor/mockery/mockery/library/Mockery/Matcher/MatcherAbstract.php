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

namespace Mockery\Matcher;

<<<<<<< HEAD
abstract class MatcherAbstract
=======
/**
 * @deprecated Implement \Mockery\Matcher\MatcherInterface instead of extending this class
 * @see https://github.com/mockery/mockery/pull/1338
 */
abstract class MatcherAbstract implements MatcherInterface
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
{
    /**
     * The expected value (or part thereof)
     *
<<<<<<< HEAD
     * @var mixed
=======
     * @template TExpected
     *
     * @var TExpected
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    protected $_expected = null;

    /**
     * Set the expected value
     *
<<<<<<< HEAD
     * @param mixed $expected
=======
     * @template TExpected
     *
     * @param TExpected $expected
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
     */
    public function __construct($expected = null)
    {
        $this->_expected = $expected;
    }
<<<<<<< HEAD

    /**
     * Check if the actual value matches the expected.
     * Actual passed by reference to preserve reference trail (where applicable)
     * back to the original method parameter.
     *
     * @param mixed $actual
     * @return bool
     */
    abstract public function match(&$actual);

    /**
     * Return a string representation of this Matcher
     *
     * @return string
     */
    abstract public function __toString();
=======
>>>>>>> 1f0e266bb249cbedf94582f0150e55e588e364c1
}
